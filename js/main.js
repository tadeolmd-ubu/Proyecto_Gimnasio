document.addEventListener('DOMContentLoaded', () => {
    // Elementos del Menú Móvil
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const closeMenuBtn = document.getElementById('closeMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileLinks = document.querySelectorAll('.mobile-link');

    // Elementos del Modal de Inicio de Sesión
    const loginModal = document.getElementById('loginModal');
    const openLoginBtn = document.getElementById('openLoginBtn'); // Botón en versión de escritorio
    const mobileLoginBtn = document.getElementById('mobileLoginBtn'); // Botón en versión móvil
    const closeModalBtn = document.getElementById('closeModalBtn');
    
    // Elementos del Modal de Registro
    const registerModal = document.getElementById('registerModal');
    const openRegisterBtn = document.getElementById('openRegisterBtn');
    const closeRegisterModalBtn = document.getElementById('closeRegisterModalBtn');
    const backToLoginBtn = document.getElementById('backToLoginBtn');
    const heroRegisterBtn = document.getElementById('heroRegisterBtn'); // Botón principal (Hero)

    // Elementos del Formulario
    const loginForm = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const userError = document.getElementById('userError');
    const passError = document.getElementById('passError');

    // Función para alternar la visibilidad del menú móvil
    function toggleMobileMenu() {
        mobileMenu.classList.toggle('active');
    }

    // Configuración de eventos para el menú móvil
    if (mobileMenuBtn && closeMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        closeMenuBtn.addEventListener('click', toggleMobileMenu);

        // Cierra el menú móvil al hacer clic en un enlace de navegación
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
            });
        });
    }

    // Función para abrir el modal de inicio de sesión
    function openModal(e) {
        if(e) e.preventDefault();
        loginModal.classList.add('active');
        resetErrors(); // Reinicia los mensajes de error al abrir el modal
    }

    // Función para cerrar el modal de inicio de sesión
    function closeModal() {
        loginModal.classList.remove('active');
    }

    // Configuración de eventos para el modal de inicio de sesión
    if (openLoginBtn && closeModalBtn && loginModal) {
        openLoginBtn.addEventListener('click', openModal);
        if(mobileLoginBtn) mobileLoginBtn.addEventListener('click', openModal);
        
        closeModalBtn.addEventListener('click', closeModal);

        // Cierra el modal si se hace clic en el fondo oscuro (fuera del contenido)
        loginModal.addEventListener('click', (e) => {
            if (e.target === loginModal) {
                closeModal();
            }
        });
    }

    // --- Lógica del Modal de Registro ---
    // Función para abrir el modal de registro
    function openRegisterModal(e) {
        if(e) e.preventDefault();
        closeModal(); // Cierra el modal de inicio de sesión si estuviera abierto
        registerModal.classList.add('active');
    }

    // Función para cerrar el modal de registro
    function closeRegisterModal() {
        registerModal.classList.remove('active');
    }

    // Configuración de eventos para el modal de registro
    if(openRegisterBtn && closeRegisterModalBtn && registerModal) {
        openRegisterBtn.addEventListener('click', openRegisterModal);
        closeRegisterModalBtn.addEventListener('click', closeRegisterModal);
        
        // Cierra el modal de registro si se hace clic en el fondo oscuro
        registerModal.addEventListener('click', (e) => {
            if (e.target === registerModal) {
                closeRegisterModal();
            }
        });

        // Botón para volver al inicio de sesión desde el formulario de registro
        if(backToLoginBtn) {
            backToLoginBtn.addEventListener('click', (e) => {
                if(e) e.preventDefault();
                closeRegisterModal();
                openModal();
            });
        }
        
        // Permite abrir el registro desde el botón de la sección principal (hero)
        if(heroRegisterBtn) {
            heroRegisterBtn.addEventListener('click', openRegisterModal);
        }
    }

    // Función para reiniciar (ocultar) los mensajes de error del formulario
    function resetErrors() {
        userError.style.display = 'none';
        passError.style.display = 'none';
        usernameInput.style.borderColor = 'rgba(255,255,255,0.1)';
        passwordInput.style.borderColor = 'rgba(255,255,255,0.1)';
    }

    // Validación del formulario de inicio de sesión antes de enviarlo
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            let isValid = true;
            resetErrors();

            // Muestra error si el campo de usuario está vacío
            if (usernameInput.value.trim() === '') {
                userError.style.display = 'block';
                usernameInput.style.borderColor = 'var(--error-color)';
                isValid = false;
            }

            // Muestra error si el campo de contraseña está vacío
            if (passwordInput.value.trim() === '') {
                passError.style.display = 'block';
                passwordInput.style.borderColor = 'var(--error-color)';
                isValid = false;
            }

            // Evita que el formulario se envíe si hay errores de validación
            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Configura el desplazamiento suave (smooth scroll) para todos los enlaces internos (#)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            if(this.getAttribute('href') !== '#') {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if(target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});

// Configuración del IntersectionObserver para animaciones al hacer scroll hacia abajo
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    // Cuando un elemento entra en el área visible de la pantalla...
    if (entry.isIntersecting) {
      // ... se le añade la clase 'visible' para activar su animación CSS
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.12 }); // threshold define qué porcentaje del elemento debe verse (12%)

// Aplica este observador a todos los elementos HTML que tengan la clase 'fade-up'
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

// ============================================================
// WIZARD DE INSCRIPCIÓN
// ============================================================
(function() {
    const modal = document.getElementById('inscripcionModal');
    const closeBtn = document.getElementById('closeInscripcionModal');
    const openBtns = document.querySelectorAll('[data-open-inscripcion]');

    if (!modal) return;

    let currentStep = 1;
    const wizardData = { plan: null, entrenador: null };

    // Abrir modal
    openBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.add('active');
            resetWizard();
        });
    });

    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });

    function resetWizard() {
        currentStep = 1;
        wizardData.plan = null;
        wizardData.entrenador = null;
        document.querySelectorAll('.plan-card.selected').forEach(c => c.classList.remove('selected'));
        document.querySelectorAll('.entrenador-card.selected').forEach(c => c.classList.remove('selected'));
        document.getElementById('step1Next').disabled = true;
        document.getElementById('step2Next').disabled = true;
        var errorDiv = document.getElementById('wizardError');
        if (errorDiv) errorDiv.style.display = 'none';
        showStep(1);
    }

    function showStep(step) {
        document.querySelectorAll('.wizard-step').forEach(el => el.style.display = 'none');
        const target = step === 0 ? document.getElementById('stepLoading')
                    : step === 4 ? document.getElementById('stepSuccess')
                    : document.getElementById('step' + step);
        if (target) target.style.display = 'block';

        document.querySelectorAll('.wizard-step-indicator').forEach((el, i) => {
            el.classList.remove('active', 'completed');
            if (step > 0 && i + 1 === step) el.classList.add('active');
            else if (step > 0 && i + 1 < step) el.classList.add('completed');
        });
    }

    // ── Paso 1: Plan ──
    document.querySelectorAll('.plan-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            wizardData.plan = {
                id: card.dataset.planId,
                name: card.dataset.planName,
                price: card.dataset.planPrice
            };
            document.getElementById('step1Next').disabled = false;
        });
    });

    document.getElementById('step1Next').addEventListener('click', () => {
        if (!wizardData.plan) return;
        currentStep = 2;
        showStep(2);
    });

    // ── Paso 2: Entrenador ──
    document.querySelectorAll('.entrenador-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.entrenador-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            wizardData.entrenador = {
                id: card.dataset.entrenadorId,
                name: card.dataset.entrenadorName
            };
            document.getElementById('step2Next').disabled = false;
        });
    });

    document.getElementById('skipTrainer').addEventListener('click', () => {
        document.querySelectorAll('.entrenador-card').forEach(c => c.classList.remove('selected'));
        wizardData.entrenador = null;
        advanceToConfirm();
    });

    document.getElementById('step2Next').addEventListener('click', () => {
        if (!wizardData.entrenador) {
            document.getElementById('step2Next').disabled = true;
            return;
        }
        advanceToConfirm();
    });

    function advanceToConfirm() {
        currentStep = 3;
        showStep(3);
        populateSummary();
    }

    function populateSummary() {
        document.getElementById('summaryPlan').textContent = wizardData.plan
            ? wizardData.plan.name + ' — $' + Number(wizardData.plan.price).toLocaleString('es-MX')
            : '—';
        document.getElementById('summaryEntrenador').textContent = wizardData.entrenador
            ? wizardData.entrenador.name
            : 'Sin entrenador';
        document.getElementById('summaryPrecio').textContent = wizardData.plan
            ? '$' + Number(wizardData.plan.price).toLocaleString('es-MX')
            : '—';
    }

    // ── Botones Atrás ──
    document.querySelectorAll('.btn-back').forEach(btn => {
        btn.addEventListener('click', () => {
            const backTo = parseInt(btn.dataset.back);
            currentStep = backTo;
            showStep(currentStep);
            if (currentStep === 2) {
                document.getElementById('step2Next').disabled = !wizardData.entrenador;
            }
        });
    });

    // ── Confirmar ──
    // Enviar la solicitud de inscripcion al servidor via fetch.
    // Si el servidor devuelve error (por ejemplo membresia activa),
    // se regresa al paso 3 y se muestra el mensaje dentro del modal
    // en lugar de usar alert() o redirigir.
    document.getElementById('confirmBtn').addEventListener('click', () => {
        if (!wizardData.plan) return;

        var errorDiv = document.getElementById('wizardError');
        errorDiv.style.display = 'none';

        showStep(0); // loading
        document.querySelector('#stepLoading h2').textContent = 'Procesando...';
        document.querySelector('#stepLoading p').textContent = 'Estamos registrando tu inscripción';

        fetch('../php/inscripcion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                plan_id: wizardData.plan.id,
                entrenador_id: wizardData.entrenador ? wizardData.entrenador.id : null
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                currentStep = 4;
                showStep(4);
            } else {
                // Mostrar el error (como membresia activa) dentro del modal
                currentStep = 3;
                showStep(3);
                errorDiv.textContent = data.message;
                errorDiv.style.display = 'block';
            }
        })
        .catch(err => {
            // Error de red: mostrar el mensaje en el modal sin recargar
            currentStep = 3;
            showStep(3);
            errorDiv.textContent = 'Error de conexión. Intenta de nuevo.';
            errorDiv.style.display = 'block';
        });
    });

    // ── Finalizar ──
    document.getElementById('finishBtn').addEventListener('click', () => {
        modal.classList.remove('active');
        document.getElementById('hero').scrollIntoView({ behavior: 'smooth' });
    });
})();