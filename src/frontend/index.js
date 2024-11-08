// frontend/src/index.js

import React, { useState } from "react";
import ReactDOM from "react-dom";
import "./tailwind.css"; // Import Tailwind CSS for the frontend
import ContactForm from "./ContactForm";

ReactDOM.render(
  <ContactForm />,
  document.getElementById("my-plugin-contact-form")
);
