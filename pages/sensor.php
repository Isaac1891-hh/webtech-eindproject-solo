<?php require_once '../includes/header.php'; ?>

<section class="card">
    <h2>Smartphone als sensor</h2>
    <p>Open deze pagina op je smartphone. De browser leest batterijpercentage en locatie uit en stuurt die via REST naar PHP.</p>
    <button id="sendSensor">Stuur sensordata</button>
    <p id="sensorMessage"></p>
</section>

<script>
document.getElementById('sendSensor').addEventListener('click', async function () {
    const message = document.getElementById('sensorMessage');
    message.textContent = 'Data wordt verzameld...';

    let batteryLevel = null;

    if (navigator.getBattery) {
        try {
            const battery = await navigator.getBattery();
            batteryLevel = Math.round(battery.level * 100);
        } catch (error) {
            batteryLevel = null;
        }
    }

    function sendData(latitude, longitude) {
        const sensorData = {
            battery: batteryLevel,
            latitude: latitude,
            longitude: longitude
        };

        fetch('../api/save_sensor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(sensorData)
        })
        .then(response => response.json())
        .then(result => {
            message.textContent = result.message;
        })
        .catch(() => {
            message.textContent = 'Fout bij verzenden naar REST API.';
        });
    }

    if (!navigator.geolocation) {
        message.textContent = 'Deze browser ondersteunt geen locatie.';
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function (position) {
            sendData(
                position.coords.latitude,
                position.coords.longitude
            );
        },
        function () {
            message.textContent = 'Locatie kon niet gelezen worden. Controleer toestemming.';
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
});
</script>

<?php require_once '../includes/footer.php'; ?>
