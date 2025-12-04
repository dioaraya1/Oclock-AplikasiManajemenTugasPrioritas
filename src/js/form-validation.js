// form-validation.js
// Form validation
function initForms() {
  const forms = document.querySelectorAll("form[data-validate]");
  forms.forEach((form) => {
    form.addEventListener("submit", validateForm);
  });
}

// Form validation handler
function validateForm(event) {
  event.preventDefault();
  // Implementasi validasi form
  console.log("Validating form:", event.target);
  // return true/false berdasarkan validasi
}

export { initForms };
