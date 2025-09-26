<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome - UniDeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      .tab-active {
        border-bottom: 2px solid #3b82f6;
        color: #3b82f6;
      }
    </style>
  </head>
  <body
    class="bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center h-screen p-4"
  >
    <div
      class="w-full max-w-md bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg p-8"
    >
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">UniDeli</h1>
        <p class="text-gray-500">Your Campus Delivery Hub</p>
      </div>
      <div class="flex border-b mb-6">
        <button
          id="login-tab"
          class="flex-1 py-2 font-semibold text-gray-600 tab-active"
          onclick="showForm('login')"
        >
          Login
        </button>
        <button
          id="signup-tab"
          class="flex-1 py-2 font-semibold text-gray-500"
          onclick="showForm('signup')"
        >
          Sign Up
        </button>
      </div>
      <form
        id="login-form"
        action="api/login_handler.php"
        method="POST"
        class="space-y-6"
      >
        <div>
          <label
            for="login-email"
            class="block text-sm font-medium text-gray-700"
            >Email</label
          >
          <input
            type="email"
            name="email"
            id="login-email"
            required
            class="mt-1 block w-full px-4 py-2 bg-white/50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        <div>
          <label
            for="login-password"
            class="block text-sm font-medium text-gray-700"
            >Password</label
          >
          <input
            type="password"
            name="password"
            id="login-password"
            required
            class="mt-1 block w-full px-4 py-2 bg-white/50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        <button
          type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105"
        >
          Login
        </button>
      </form>
      <form
        id="signup-form"
        action="api/signup_handler.php"
        method="POST"
        class="space-y-6 hidden"
      >
        <div>
          <label
            for="signup-name"
            class="block text-sm font-medium text-gray-700"
            >Full Name</label
          >
          <input
            type="text"
            name="full_name"
            id="signup-name"
            required
            class="mt-1 block w-full px-4 py-2 bg-white/50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        <div>
          <label
            for="signup-email"
            class="block text-sm font-medium text-gray-700"
            >Email</label
          >
          <input
            type="email"
            name="email"
            id="signup-email"
            required
            class="mt-1 block w-full px-4 py-2 bg-white/50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        <div>
          <label
            for="signup-password"
            class="block text-sm font-medium text-gray-700"
            >Password</label
          >
          <input
            type="password"
            name="password"
            id="signup-password"
            required
            class="mt-1 block w-full px-4 py-2 bg-white/50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        <button
          type="submit"
          class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105"
        >
          Create Account
        </button>
      </form>
    </div>
    <script>
      const loginForm = document.getElementById("login-form"),
        signupForm = document.getElementById("signup-form"),
        loginTab = document.getElementById("login-tab"),
        signupTab = document.getElementById("signup-tab");
      function showForm(formName) {
        formName === "login"
          ? (loginForm.classList.remove("hidden"),
            signupForm.classList.add("hidden"),
            loginTab.classList.add("tab-active"),
            signupTab.classList.remove("tab-active"))
          : (loginForm.classList.add("hidden"),
            signupForm.classList.remove("hidden"),
            loginTab.classList.remove("tab-active"),
            signupTab.classList.add("tab-active"));
      }
    </script>
  </body>
</html>
