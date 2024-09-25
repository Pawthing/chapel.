<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Heatmap</title>

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
    <select id="org_name" required>
      <option value="">-Select Organization-</option>
      <option value="Choir">Choir</option>
      <option value="COMI">COMI</option>
      <option value="Knights">Knights</option>
      <option value="LecCom">LecCom</option>
      <option value="Multimedia">Multimedia</option>
      <option value="Usherette">Usherette</option>
    </select>
    <button onclick="createUser()">Create User</button>
    <button onclick="showUsers()">Show Users</button>
    <button onclick="deleteUser()">Delete User</button>
    <button onclick="updateUser()">Update User</button>
    <button><a href="./dashboard_admin.php">Dashboard</button></a>
    

  </div>
  <div id="map"></div>
</body>

</html>

<!-- leaflet js -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
  // Map initialization
  var map = L.map('map').setView([12.8787, 121.7740], 5);

  // OSM layer
  var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  });
  osm.addTo(map);

  // Load users from localStorage, or initialize an empty array if none exist
  var users = JSON.parse(localStorage.getItem('users')) || [];

  // Array to hold markers and circles
  var markers = [];

  // Function to load users' markers from localStorage
  function loadMarkers() {
    users.forEach((user, index) => {
      if (user.lat && user.long) {
        let marker = L.marker([user.lat, user.long]).addTo(map);
        let circle = L.circle([user.lat, user.long], { radius: user.accuracy }).addTo(map);
        marker.bindPopup("<b>" + user.name + "</b><br>" + user.address + "<br>Lat: " + user.lat + "<br>Long: " + user.long);
        markers.push({ marker, circle });
      }
    });
  }

  // Load markers when the page loads
  window.onload = function() {
    loadMarkers();
  };

  // Function to save users data to localStorage
  function saveUsersToLocalStorage() {
    localStorage.setItem('users', JSON.stringify(users));
  }

  // Function to create a new user
  function createUser() {
    var name = document.getElementById('name').value;
    var address = document.getElementById('address').value;
    var org_name = document.getElementById('org_name').value;

    if (name && address) {
      navigator.geolocation.getCurrentPosition(position => {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;

        users.push({ name: name, address: address, org_name: org_name, lat: lat, long: long, accuracy: accuracy });
        saveUsersToLocalStorage();  // Save the new user to localStorage

        alert("User created: " + name + ", " + address + ", " + org_name);

        // Create marker for the new user
        let marker = L.marker([lat, long]).addTo(map);
        let circle = L.circle([lat, long], { radius: accuracy }).addTo(map);
        marker.bindPopup("<b>" + name + "</b><br>" + address + "<br>Lat: " + lat + "<br>Long: " + long);
        markers.push({ marker, circle });

        // Fit map bounds to markers
        var featureGroup = L.featureGroup([marker, circle]).addTo(map);
        map.fitBounds(featureGroup.getBounds());

        // Clear the input fields after creation
      document.getElementById('name').value = '';
      document.getElementById('address').value = '';
      document.getElementById('org_name').value = '';
      });
    } else {
      alert("Please enter both name and address");
    }
  }

  // Function to show current users
  function showUsers() {
    if (users.length === 0) {
      alert("No users available.");
    } else {
      var userList = "Current Users:\n";
      users.forEach((user, index) => {
        userList += index + 1 + ". " + user.name + " - " + user.address + " - " + user.org_name + "\n";
      });
      alert(userList);
    }
  }

  // Function to delete a user
  function deleteUser() {
    var name = document.getElementById('name').value;
    var index = users.findIndex(user => user.name === name);
    if (index !== -1) {
      users.splice(index, 1); // Remove user from the users array
      saveUsersToLocalStorage();  // Update localStorage

      // Remove marker and circle from the map
      if (markers[index]) {
        map.removeLayer(markers[index].marker);
        map.removeLayer(markers[index].circle);
      }
      markers.splice(index, 1); // Remove the marker from the markers array

      alert("User deleted: " + name);

      // Clear the input fields after deletion
      document.getElementById('name').value = '';
      document.getElementById('address').value = '';
      document.getElementById('org_name').value = '';
    } else {
      alert("User not found.");
    }
  }

  // Function to update a user's address
  function updateUser() {
    var name = document.getElementById('name').value;
    var newAddress = document.getElementById('address').value;
    var newOrg_name = document.getElementById('org_name').value;
    var index = users.findIndex(user => user.name === name);
    if (index !== -1 && newAddress) {
      users[index].address = newAddress;
      users[index].org_name = newOrg_name;
      saveUsersToLocalStorage();  // Update localStorage
      alert("User updated: " + name + ", New Address: " + newAddress + ", Organization: " + newOrg_name);

      // Clear the input fields after update
      document.getElementById('name').value = '';
      document.getElementById('address').value = '';
      document.getElementById('org_name').value = '';
    } else {
      alert("User not found or no new address entered.");
    }
  }
</script>