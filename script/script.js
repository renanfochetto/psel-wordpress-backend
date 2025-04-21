// Validação do Formulário

document.addEventListener('DOMContentLoaded', () => {
  const firstNumberElement = document.querySelector('.validation-firstnumber');
  const secondNumberElement = document.querySelector('.validation-secondnumber');
  const resultInput = document.querySelector('#resultado');
  const form = document.querySelector('.form-field');
  const button = document.querySelector('.form-button');

  // Geração de números aleatórios
  const firstNumber = Math.floor(Math.random() * 100);
  const secondNumber = Math.floor(Math.random() * 100);

  firstNumberElement.textContent = firstNumber;
  secondNumberElement.textContent = secondNumber;

  //Aplicando classes para estilização
  firstNumberElement.classList.add('generated-number');
  secondNumberElement.classList.add('generated-number');

  // Cálculo da soma correta
  const correctSum = firstNumber + secondNumber;

  // Função para validar o formulário e habilitar o botão
  const validateForm = () => {
    const userInput = parseInt(resultInput.value, 10);
    if (form.checkValidity() && userInput === correctSum) {
      button.disabled = false;
    } else {
      button.disabled = true;
    }
  };

  // Eventos para validação
  resultInput.addEventListener('input', validateForm);
  form.addEventListener('input', validateForm);

  // Garante que o botão comece desabilitado
  button.disabled = true;
});


//Efeito de seleção nas Tags
document.addEventListener('DOMContentLoaded', () => {
  const tags = document.querySelectorAll('.tags-wrapper span');

  tags.forEach(tag => {
    tag.addEventListener('click', () => {
      tag.classList.toggle('selected');
    });
  });
});

//Bloqueando comportamento padrão nos links
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('a');

  links.forEach(link => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
    });
  });
});

// Abertura e fechamento do menu

document.addEventListener('DOMContentLoaded', () => {
  const headerMenu = document.querySelector('.header-menu');
  const headerNav = document.querySelector('.header-nav');
  const navList = document.querySelector('.header-nav_list');
  const menuIcon = document.querySelector('.menu-icon');
  const closeIcon = document.querySelector('.close-icon');
  const navListImg = document.querySelector('.header-nav_list li:last-child');

  headerMenu.addEventListener('click', () => {
    headerNav.classList.toggle('active');
    navList.classList.toggle('active');
    navListImg.classList.toggle('active');
    console.log(navListImg)
    // Alterna a exibição dos ícones
    if (menuIcon.style.display === 'none') {
      menuIcon.style.display = 'block';
      closeIcon.style.display = 'none';
    } else {
      menuIcon.style.display = 'none';
      closeIcon.style.display = 'block';
    }
  });
});


