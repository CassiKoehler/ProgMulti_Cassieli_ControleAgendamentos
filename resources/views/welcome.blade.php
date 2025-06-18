<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Agendamentos</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animated background particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(236, 72, 153, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-20px) rotate(180deg); opacity: 0.8; }
        }
        
        .container {
            position: relative;
            z-index: 2;
        }
        
        /* Header styles */
        .header {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(236, 72, 153, 0.2);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
            font-weight: 700;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            color: #ec4899;
            filter: drop-shadow(0 0 10px rgba(236, 72, 153, 0.4));
        }
        
        .nav-buttons {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .btn-secondary {
            background: rgba(51, 65, 85, 0.6);
            color: white;
            border: 1px solid rgba(148, 163, 184, 0.3);
        }
        
        .btn-secondary:hover {
            background: rgba(71, 85, 105, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(236, 72, 153, 0.4);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        /* Main content styles */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
        }
        
        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: #cbd5e1;
            max-width: 600px;
            margin: 0 auto 3rem;
            line-height: 1.6;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }
        
        .btn-cta {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 1rem;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-cta-primary {
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(236, 72, 153, 0.3);
        }
        
        .btn-cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(236, 72, 153, 0.4);
        }
        
        .btn-cta-secondary {
            background: rgba(30, 41, 59, 0.8);
            color: white;
            border: 2px solid rgba(236, 72, 153, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .btn-cta-secondary:hover {
            background: rgba(51, 65, 85, 0.9);
            border-color: rgba(236, 72, 153, 0.6);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        
        /* Features section */
        .features {
            margin-top: 4rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }
        
        .feature-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(148, 163, 184, 0.1);
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(236, 72, 153, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .feature-icon {
            width: 48px;
            height: 48px;
            color: #ec4899;
            margin: 0 auto 1rem;
            filter: drop-shadow(0 0 10px rgba(236, 72, 153, 0.3));
        }
        
        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }
        
        .feature-desc {
            color: #cbd5e1;
            line-height: 1.5;
        }
        
        /* Footer styles */
        .footer {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(236, 72, 153, 0.2);
            padding: 2rem;
            text-align: center;
            color: #94a3b8;
            margin-top: 4rem;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .main {
                padding: 2rem 1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-cta {
                width: 100%;
                max-width: 300px;
            }
            
            .features {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="particles" id="particles"></div>
    
    <div class="container">
        <header class="header">
            <div class="header-content">
                <div class="logo">
                    <i data-lucide="calendar-check" class="logo-icon"></i>
                    <span>Sistema Cassieli</span>
                </div>
                <nav class="nav-buttons">
                    <a href="{{ route('login') }}" class="btn btn-secondary">Fazer Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Criar Conta</a>
                </nav>
            </div>
        </header>

        <main class="main">
            <h1 class="hero-title">
                Gerencie seus <span style="color: #ec4899;">Agendamentos</span><br>
                com Eficiência
            </h1>
            <p class="hero-subtitle">
                Sistema completo para salões de beleza, clínicas e consultórios. 
                Organize tudo em um só lugar de forma simples e profissional.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="btn-cta btn-cta-primary">Começar Agora</a>
                <a href="{{ route('login') }}" class="btn-cta btn-cta-secondary">Já tenho conta</a>
            </div>
            
            <div class="features">
                <div class="feature-card">
                    <i data-lucide="users" class="feature-icon"></i>
                    <h3 class="feature-title">Gestão de Clientes</h3>
                    <p class="feature-desc">Cadastre e gerencie informações completas dos seus clientes com histórico detalhado</p>
                </div>
                <div class="feature-card">
                    <i data-lucide="user-check" class="feature-icon"></i>
                    <h3 class="feature-title">Controle de Profissionais</h3>
                    <p class="feature-desc">Organize sua equipe, horários de trabalho e especialidades de cada profissional</p>
                </div>
                <div class="feature-card">
                    <i data-lucide="scissors" class="feature-icon"></i>
                    <h3 class="feature-title">Catálogo de Serviços</h3>
                    <p class="feature-desc">Defina todos os serviços oferecidos com preços, duração e descrições detalhadas</p>
                </div>
                <div class="feature-card">
                    <i data-lucide="calendar-days" class="feature-icon"></i>
                    <h3 class="feature-title">Sistema de Agendamentos</h3>
                    <p class="feature-desc">Agenda inteligente que conecta clientes, profissionais e serviços automaticamente</p>
                </div>
            </div>
        </main>

        <footer class="footer">
            <p>© {{ now()->year }} Sistema Cassieli · Todos os direitos reservados</p>
        </footer>
    </div>

    <script>
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Create animated background particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                
                // Random animation delay and duration
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
                
                particlesContainer.appendChild(particle);
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Initialize particles when page loads
        window.addEventListener('load', createParticles);

        // Add hover effects to buttons
        document.querySelectorAll('.btn, .btn-cta').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add intersection observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe feature cards for scroll animations
        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>
</html>