{% extends "main.tpl.php" %}
{% block content %}
  <div class="content" >
      <ul class="g">
          {% for item in items %}
          <li>
            <a class="href-replace" href="item/{{item.id}}">
              <div class="edit-item-img" style="background-image: url('{{item.imgurl}}');background-size: cover;"></div>
              <div class="edit-item-desc">
                <span class="edit-item-name">{{item.name}}</span>
                <!--<span class="edit-item-description">{{item.description}}</span>-->
              </div>
            </a>
          </li>
          {% endfor %}
      </ul>
    </div>

{% endblock %}
