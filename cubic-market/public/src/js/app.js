/* NAVBAR */
const menu = document.querySelector('.list-nav');
const navBar = document.querySelector('nav');
const btnBurgerActive = document.querySelector('.active');
const btnBurgerInactive = document.querySelector('.inactive');
const btnMenu = document.querySelector('.btn-toggle-container');

if (btnMenu && menu) {
    btnMenu.addEventListener('click', function(){
        menu.classList.toggle('active-menu');
        navBar.classList.toggle('active-menu');
        btnBurgerActive.classList.toggle('active-menu');
        btnBurgerInactive.classList.toggle('active-menu');
    })
}

/* ADD IMAGE PRODUCT*/

const productInputs = document.querySelectorAll('[id^="addPicture"]');

productInputs.forEach((input, index) => {
  input.addEventListener('change', function() {
    const file = this.files[0];
    // On cible l'image correspondante par son index ou un ID lié
    const targetDisplay = document.getElementById(`displayImg${index + 1}`);
    
    if (file && targetDisplay) {
      const reader = new FileReader();
      reader.onload = function(e) { 
        targetDisplay.src = e.target.result; 
      };
      reader.readAsDataURL(file);
    }
  });
});

const radios = document.querySelectorAll('input[name="host"]');
const contents = document.querySelectorAll('.toggle-content');

radios.forEach(radio => {
    radio.addEventListener('change', () => {
        contents.forEach(div => {
            div.style.display = 'none';
            const inputs = div.querySelectorAll('input, textarea, select');
            inputs.forEach(input => input.required = false);
        });
        
        const targetId = 'content-' + radio.value;
        const targetDiv = document.getElementById(targetId);
        
        if (targetDiv) {
            targetDiv.style.display = 'block';
            const targetInputs = targetDiv.querySelectorAll('input, textarea, select');
            targetInputs.forEach(input => input.required = true);
        }
    });
});