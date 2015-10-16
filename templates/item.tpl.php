{% extends "main.tpl.php" %}
{% block content %}
  <div class="content">
      <form action="" method="post" class="form">
        <input type="hidden" id="id" value="{{item.id}}" placeholder="" />
        <h1>
            <span>{{item.name}}</span>
        </h1>

        <label>
            <span>Název:</span>
            <input id="name" type="text" name="name" value="{{item.name}}" placeholder="" />
        </label>

        <label>
            <span>Popis:</span>
            <textarea id="message" name="description" value="" placeholder="">{{item.description}}</textarea>
        </label>
        <label>
           <span>Obrázek</span>
           <input data-name="item_{{item.id}}" type="file" id="imgupload"/>
        </label>
        <label>
            <span>&nbsp;</span>
            <input type="button" class="button save" value="Uložit"/>
            <img class="loading" src="./assets/loading.gif">
        </label>
    </form>
  </div>
{% endblock %}

{% block scripts %}
  <script type="text/javascript" src="./js/item_edit.js"></script>
{% endblock %}

{% block styles %}
  <style rel='stylesheet' type='text/css'>
    body{
      background: url('assets/images/{{item.image}}.jpg?{{item.mtime}}') no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
  </style>
{% endblock %}
