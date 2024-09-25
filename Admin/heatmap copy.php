<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Heatmap with CRUD</title>

  <!-- leaflet css -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

  <style>
    body {
      margin: 0;
      padding: 0;
    }

    #map {
      width: 100%;
      height: 100vh;
    }

    #controls {
      margin: 10px;
    }
  </style>

</head>

<body>
  <div id="controls">
    <input type="text" id="name" placeholder="Name">
    <input type="text" id="address" placeholder="Street/Purok">
    <button onclick="createUser()">Add Mark</button>
    <button onclick="showUsers()">Show Users</button>
    <button onclick="deleteUser()">Delete User</button>
    <button onclick="updateUser()">Update User</button>
    <button><a href="./dashboard_admin.php">Dashboard</button></a>
  </div>
  <div id="map"></div>
</body>

</html>

leaflet js
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
  // map initialization
  var map = L.map('map').setView([14.0860746, 100.608406], 6);

  // OSM layer
  var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  });
  osm.addTo(map);

  // Simulated user data (CRUD operations will be on this array)
  var users = [];

  // Array to hold markers and circles
  var markers = [];

  // Check if geolocation is supported
  if (!navigator.geolocation) {
    console.log("Your Browser doesn't support geolocation feature");
  } else {
    setInterval(() => {
      navigator.geolocation.getCurrentPosition(getPosition);
    }, 5000);
  }

  function getPosition(position) {
    var lat = position.coords.latitude;
    var long = position.coords.longitude;
    var accuracy = position.coords.accuracy;

    // Check if there is at least one user
    if (users.length > 0) {
      // Update all user markers
      users.forEach((user, index) => {
        if (user.lat && user.long) {
          // If user already has a marker, update it
          if (markers[index]) {
            markers[index].marker.setLatLng([user.lat, user.long]);
            markers[index].circle.setLatLng([user.lat, user.long]).setRadius(user.accuracy);
          } else {
            // If no marker exists, create a new one
            let marker = L.marker([user.lat, user.long]).addTo(map);
            let circle = L.circle([user.lat, user.long], { radius: user.accuracy }).addTo(map);

            marker.bindPopup("<b>" + user.name + "</b><br>" + user.address + "<br>Lat: " + user.lat + "<br>Long: " + user.long).openPopup();

            // Save the marker and circle in the markers array
            markers[index] = { marker, circle };

            // Create a feature group with marker and circle and fit bounds
            var featureGroup = L.featureGroup([marker, circle]).addTo(map);
            map.fitBounds(featureGroup.getBounds());
          }
        }
      });
    }
  }

  // CRUD Functions
  function createUser() {
    var name = document.getElementById('name').value;
    var address = document.getElementById('address').value;

    if (name && address) {
      navigator.geolocation.getCurrentPosition(position => {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;

        users.push({ name: name, address: address, lat: lat, long: long, accuracy: accuracy });

        alert("User created: " + name + ", " + address);
        getPosition(position);  // Update markers on the map for the new user
      });
    } else {
      alert("Please enter both name and address");
    }
  }

  function showUsers() {
    if (users.length === 0) {
      alert("No users available.");
    } else {
      var userList = "Current Users:\n";
      users.forEach((user, index) => {
        userList += index + 1 + ". " + user.name + " - " + user.address + "\n";
      });
      alert(userList);
    }
  }

  function deleteUser() {
    var name = document.getElementById('name').value;
    var index = users.findIndex(user => user.name === name);
    if (index !== -1) {
      users.splice(index, 1);

      // Remove marker and circle from the map
      if (markers[index]) {
        map.removeLayer(markers[index].marker);
        map.removeLayer(markers[index].circle);
      }
      markers.splice(index, 1);

      alert("User deleted: " + name);
    } else {
      alert("User not found.");
    }
  }

  function updateUser() {
    var name = document.getElementById('name').value;
    var newAddress = document.getElementById('address').value;
    var index = users.findIndex(user => user.name === name);
    if (index !== -1 && newAddress) {
      users[index].address = newAddress;
      alert("User updated: " + name + ", New Address: " + newAddress);
    } else {
      alert("User not found or no new address entered.");
    }
  }
</script>
