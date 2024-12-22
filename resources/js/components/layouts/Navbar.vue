<template>
    <nav class="navbar ">
      <div class="container">
        <a href="/" class="navbar-brand">My App</a>
        <ul class="d-flex  mb-0">
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/about">About</router-link></li>
        </ul>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    name: "Navbar",
  };
  </script>
  
  <style scoped>
  .navbar {
    background-color: #5A4C8E;
    color: white;
    padding: 1rem;
  }
  .navbar a {
    color: white;
    text-decoration: none;
    margin-right: 1rem;
  }
  </style>
  