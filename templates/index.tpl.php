{% extends "main.tpl.php" %}
{% block content %}
  <span class="main-header"> NFC? </span>
  <div class="content">
    <div class="login-wrap">
      <form action="login" class="login-form" method="POST">
        <p class="login-header">Přihlašovací jméno</p>
        <input type="text" name="username" class="login-text">
        <p class="login-header">Heslo</p>
        <input type="password" name="password" class="login-text password">
        <input type="submit" value="Přihlásit se" class="login-submit">
        <div class="align-right"><a class="login-register" href="register">Registrovat se</a></div>
      </form>
    </div>
  </div>
{% endblock %}
