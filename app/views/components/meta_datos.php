<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="MVC Base PHP para desarrollo de aplicaciones web">
<meta name="author" content="MVC Base PHP">
<title>MVC Base PHP</title>

<!-- CDN Tailwind -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="assets/img/favicon.180x180.png" type="image/png">

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/588f112670.js" crossorigin="anonymous"></script>

<style>
:root {
  color-scheme: dark;
  --bg-primary: #121212;
  --bg-secondary: rgb(31, 30, 30);
  --bg-tertiary: #252525;
  --bg-card-gradient-from: rgba(45, 45, 45, 0.5);
  --bg-card-gradient-to: rgba(35, 35, 35, 0.8);
  --text-primary: #ffffff;
  --text-secondary: #b3b3b3;
  --border-color: #333333;
  --border-highlight: rgba(255, 255, 255, 0.05);
  --accent-color: #6d28d9; /* Violeta/púrpura como color de acento */
  --accent-hover: #7c3aed;
  --accent-transparent: rgba(109, 40, 217, 0.1);
  --danger-color: #dc2626;
  --success-color: #059669;
  --warning-color: #d97706;
  --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
  --card-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.1),
    0 4px 6px rgba(0, 0, 0, 0.05);
}

body {
  @apply bg-gradient-to-b from-[var(--bg-primary)] to-[var(--bg-secondary)];
  color: var(--text-primary);
}

.card {
  @apply rounded-xl relative overflow-hidden;
  background: linear-gradient(
    135deg,
    var(--bg-card-gradient-from),
    var(--bg-card-gradient-to)
  );
  border: 1px solid var(--border-color);
  border-top: 1px solid var(--border-highlight);
  border-left: 1px solid var(--border-highlight);
  box-shadow: var(--card-shadow);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  backdrop-filter: blur(10px);
}

.card:hover {
  box-shadow: var(--card-shadow-hover);
  transform: translateY(-2px);
}

.card::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(
    90deg,
    transparent,
    var(--accent-color),
    transparent
  );
  opacity: 0.3;
}

.card-accent {
  position: relative;
  overflow: hidden;
}

.card-accent::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 4px;
  background-color: var(--accent-color);
  box-shadow: 0 0 8px var(--accent-color);
}

.btn-primary {
  @apply px-4 py-2 rounded-md transition-all duration-200;
  background-color: var(--accent-color);
  color: var(--text-primary);
}

.btn-primary:hover {
  background-color: var(--accent-hover);
  transform: translateY(-1px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-secondary {
  @apply px-4 py-2 rounded-md transition-all duration-200;
  background-color: var(--bg-tertiary);
  color: var(--text-primary);
  border: 1px solid var(--border-color);
}

.btn-secondary:hover {
  background-color: var(--bg-secondary);
  transform: translateY(-1px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 0.3s ease-out;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  color: var(--text-primary);
}

p,
span,
div {
  color: var(--text-secondary);
}

input,
select,
textarea {
  background-color: var(--bg-tertiary);
  border-color: var(--border-color);
  color: var(--text-primary);
}

a {
  color: var(--accent-color);
  transition: color 0.2s ease;
}

a:hover {
  color: var(--accent-hover);
}

</style>