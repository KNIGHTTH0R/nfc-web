{% extends "main.tpl.php" %}
{% block content %}
  <div class="content">
      <form action="" method="post" class="form">
        <input type="hidden" id="id" value="{{item.id}}" placeholder="" />
        <h1>
            <span>Registrovat nového uživatele</span>
        </h1>

        <label>
            <span>Jméno:</span>
            <input id="name" type="text" name="username" value="" placeholder="Minimálně 5 znaků" />
        </label>

        <label>
            <span>Heslo</span>
              <input id="name" type="text" name="password" value="" placeholder="" />
        </label>
        <label>
            <span>Heslo znovu</span>
            <input id="name" type="text" name="password2" value="" placeholder="" />
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="button" class="button save form-register-submit" value="OK"/>
        </label>
    </form>
  </div>
{% endblock %}
