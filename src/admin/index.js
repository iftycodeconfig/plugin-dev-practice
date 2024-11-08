import React from "react";
import ReactDOM from "react-dom";
import "./tailwind.css"; // Import Tailwind CSS for the frontend
import AdminPanel from "./AdminPanel";

document.addEventListener("DOMContentLoaded", () => {
  const adminRoot = document.getElementById("my-plugin-admin-dashboard");
  if (adminRoot) {
    ReactDOM.render(<AdminPanel />, adminRoot);
  }
});
