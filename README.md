<div align="center">
  <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg" width="80" height="80" alt="Laravel Logo" />
  <h1>🚀 Advanced Agentic Portfolio</h1>
  <p><strong>Um ecossistema de portfólio inteligente, dinâmico e totalmente gerenciável.</strong></p>

  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" />
</div>

---

## 📖 Sobre o Projeto

Este não é apenas um portfólio estático. É uma aplicação fullstack robusta construída para demonstrar maturidade técnica em **Laravel**, integração de banco de dados e UX/UI avançada. O projeto conta com um painel administrativo completo (CMS próprio) que permite a atualização em tempo real de todas as informações do site, desde stacks tecnológicas até a listagem de projetos.

---

## 🛠️ Arquitetura e Back-end

O coração do projeto bate com **Laravel 11**, focado em performance e organização de código.

### 🗄️ Banco de Dados & Persistência
- **MySQL Integration:** Estrutura de dados relacional para alta integridade.
- **Migrations:** Controle de versão do banco de dados (tabelas `portfolios`, `projects`, `core_stacks`).
- **Models & Eloquent:** Uso avançado de ORM para manipulação de dados, incluindo `Casts` para transformar strings do banco em arrays/objetos utilizáveis no front.

### 🔐 Painel Administrativo
- **Sistema de Autenticação:** Acesso restrito via middleware `auth`.
- **AdminController:** Lógica centralizada para processamento de formulários, upload de arquivos (convertidos para Base64 para portabilidade) e gerenciamento de CRUDs.
- **Dynamic Content:** Implementação de campos dinâmicos para links, redes sociais, resumo biográfico e contatos.

---

## 🎨 Front-end & UX

O front-end foi construído visando uma estética **premium e futurista**, utilizando **Blade Components** para máxima reusabilidade.

- **Laravel Blade:** Motor de templates para renderização server-side eficiente.
- **Tailwind CSS:** Design System customizado com efeitos de Glassmorphism, Neon Glow e animações suaves.
- **JavaScript Moderno:** 
    - Smooth Scroll customizado com algoritmo `easeInOutCubic`.
    - Radar Chart interativo (Chart.js) para visualização de skills.
    - Sistema de "Copy to Clipboard" com feedback visual em tempo real.
    - Marquee infinito em CSS puro para as Stacks.

---

## 📸 Screenshots (Preview)

<div align="center">
  <p align="center"><strong>Home - Hero Section</strong></p>
  <!-- Espaço reservado para imagem -->
  <img src="https://via.placeholder.com/1280x720/0f172a/22d3ee?text=Home+Hero+Preview" width="800" />
  
  <p align="center"><strong>Admin Dashboard</strong></p>
  <!-- Espaço reservado para imagem -->
  <img src="https://via.placeholder.com/1280x720/18181b/ffffff?text=Admin+Panel+Preview" width="800" />
</div>

---

## 🚀 Como Executar

1. Clone o repositório
2. Instale as dependências:
   ```bash
   composer install
   npm install
   ```
3. Configure o `.env` com suas credenciais MySQL.
4. Execute as migrações:
   ```bash
   php artisan migrate --seed
   ```
5. Inicie os servidores:
   ```bash
   php artisan serve
   npm run dev
   ```

---

<div align="center">
  <p>Desenvolvido por <strong>Julio Cesar Vanz</strong></p>
  <p>
    <a href="https://linkedin.com/in/Jcvanz">
      <img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" />
    </a>
  </p>
</div>
