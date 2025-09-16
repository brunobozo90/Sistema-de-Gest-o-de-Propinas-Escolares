<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colégio Betânia - Educação de Excelência</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="style.css">
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar">
    <!-- Menu Fixo -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img style="background-color: #f8f9fa; width: 50px; height: 50px;" src="../assets/img/logo1.jfif" alt=""> Colégio Betânia
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#inicio">Página Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sobre">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2" href="../login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Seção Inicial -->
    <section id="inicio" class="hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-3 fw-bold mb-4">Colégio Betânia</h1>
                    <p class="lead mb-5">Formando cidadãos com excelência e valores</p>
                    <a href="#sobre" class="btn btn-light btn-lg me-2">Conheça-nos</a>
                    <a href="../login.php" class="btn btn-outline-light btn-lg">Área do Aluno</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção Sobre Nós -->
    <section id="sobre" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row">
            <h2 class="fw-bold mb-4">Sobre o Colégio Betânia</h2>
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="lead">Uma instituição comprometida com a excelência educacional e formação integral dos alunos.</p>
                            <p>Fundado em 1990, o Colégio Betânia tem como objetivo principal oferecer uma educação de qualidade que combine conhecimento acadêmico com formação em valores éticos e morais.</p>
                            <p>Fundado em 1990, o Colégio Betânia tem como objetivo principal oferecer uma educação de qualidade que combine conhecimento acadêmico com formação em valores éticos e morais.</p>
                            <p>Fundado em 1990, o Colégio Betânia tem como objetivo principal oferecer uma educação de qualidade que combine conhecimento acadêmico com formação em valores éticos e morais.</p>
                            <p>Fundado em 1990, o Colégio Betânia tem como objetivo principal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title"><i class="bi bi-bullseye text-primary me-2"></i>Nossa Missão</h3>
                            <p class="card-text">Formar cidadãos críticos, criativos e éticos, capazes de transformar a sociedade através do conhecimento e dos valores humanos.</p>
                            
                            <h3 class="card-title mt-4"><i class="bi bi-eye text-primary me-2"></i>Nossa Visão</h3>
                            <p class="card-text">Ser referência em educação básica em Angola, reconhecida pela excelência acadêmica e formação humana.</p>
                            
                            <h3 class="card-title mt-4"><i class="bi bi-heart text-primary me-2"></i>Nossos Valores</h3>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Ética e transparência</li>
                                <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Respeito à diversidade</li>
                                <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Compromisso com a excelência</li>
                                <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Responsabilidade social</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="fw-bold mb-4">Nossas Unidades</h3>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Vila Alice</h4>
                            <p class="card-text">Rua da Escola, nº 123<br>Vila Alice, Luanda</p>
                            <p><i class="bi bi-telephone-fill text-primary me-2"></i>+244 123 456 789</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Zango</h4>
                            <p class="card-text">Avenida Principal, nº 456<br>Zango, Luanda</p>
                            <p><i class="bi bi-telephone-fill text-primary me-2"></i>+244 987 654 321</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção Contacto -->
    <section id="contacto" class="py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="fw-bold mb-4">Entre em Contacto</h2>
                    <p class="lead mb-4">Tem dúvidas ou precisa de informações? Envie-nos uma mensagem.</p>
                    
                    <div class="mb-4">
                        <h4><i class="bi bi-envelope-fill text-primary me-2"></i>Email</h4>
                        <p>geral@colegiobetania.edu.ao</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4><i class="bi bi-telephone-fill text-primary me-2"></i>Telefone</h4>
                        <p>+244 222 333 444</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4><i class="bi bi-geo-alt-fill text-primary me-2"></i>Endereço</h4>
                        <p>Rua da Escola, nº 123<br>Vila Alice, Luanda</p>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" class="btn btn-outline-primary me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-primary me-2"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-primary me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="btn btn-outline-primary"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Formulário de Contacto</h3>
                            <form id="contactForm" novalidate>
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="nome" required>
                                    <div class="invalid-feedback">Por favor, insira seu nome.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                    <div class="invalid-feedback">Por favor, insira um email válido.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="mensagem" class="form-label">Mensagem</label>
                                    <textarea class="form-control" id="mensagem" rows="4" required></textarea>
                                    <div class="invalid-feedback">Por favor, insira sua mensagem.</div>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.233163474938!2d13.234415315786723!3d-8.838537693737082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51f3b9a9d9e9a5%3A0x9a9d9e9a5a1f3b9a!2sLuanda%2C%20Angola!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h3><img style="background: #f8f9fa; width: 50px; height: 50px;" src="../assets/img/logo.png" alt=""> Colégio Betânia</h3>
                    <p class="mb-0">Educação de excelência para formar o futuro.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="../login.php" class="btn btn-outline-light">Área do Aluno/Admin</a>
                </div>
            </div>
            <hr class="my-3">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2023 Colégio Betânia. Todos os direitos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-3">Política de Privacidade</a>
                    <a href="#" class="text-white">Termos de Serviço</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS Personalizado -->
    <script src="script.js"></script>
</body>
</html>