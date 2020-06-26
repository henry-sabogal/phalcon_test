<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <h2>List Items</h2>
    </div>
    <div class="col-xs-12 col-md-6 text-right">
        {{ link_to("henry/new", "Create Item", "class": "btn btn-primary") }}
    </div>
</div>

{% for item in items %}
    {% if loop.first %}
        <table class="table table-bordered table-striped" align="center">
        <thead>
        <tr>
            <th>Id</th>
            <th>Descripción</th>
            <th>Precio</th>
        </tr>
        </thead>
        <tbody>
    {% endif %}
    <tr>
        <td>{{ item.id }}</td>
        <td>{{ item.descripcion }}</td>
        <td>${{ "%.2f"|format(item.precio) }}</td>
        <td width="7%">{{ link_to("henry/edit/" ~ item.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
        <td width="7%">{{ link_to("henry/delete/" ~ item.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
    </tr>
{% else %}
    No items are recorded
{% endfor %}

