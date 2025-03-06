const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});


// seleziona il pulsante "accedi come ospite"
const guestBtn = document.querySelector('#guest-btn');

// aggiungi un listener per il click sul pulsante
guestBtn.addEventListener('click', function() {
  // reindirizza l'utente alla pagina di accesso come ospite
  window.location.href = 'login/login_ospite.php';
});
