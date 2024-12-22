<template>
    <aside class="sidebar ">
      <ul>
        <li><router-link to="/">Dashboard</router-link></li>
        <li><router-link to="/about">Settings</router-link></li>
      </ul>
    </aside>
  </template>
  
  <script>
  export default {
    name: "Sidebar",
  };
  </script>
  
  <style scoped>
  .sidebar {
    background-color: #5A4C8E;
    width: 200px;
    min-height: 100vh;
    padding: 1rem;
    overflow-y: auto;
  }
  
  .sidebar ul {
    list-style: none;
    padding: 0;
  }
  .sidebar li {
    margin-bottom: 1rem;
  }
  .sidebar a {
    text-decoration: none;
    color: white;
  }
  </style>
  