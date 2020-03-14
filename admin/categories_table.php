<thead>
    <th>ID</th>
    <th>Название</th>
    <th>Стоимость</th>
    <th>Настройки</th>
</thead>
<tbody>
<?php
    $sql = "SELECT * FROM categories";
    $result = $connect->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['cost']; ?> $</td>
        <td>
            <a class="btn-group" role="group" aria-label="Basic example">
                <a href="options/categories/edit_categories.php?id=<?php echo $row['id']; ?>"  class="btn btn-outline-info">Редактировать</a>
                <div data-link="options/categories/delete_categories.php?id=<?php echo $row['id']; ?>"  class="btn btn-outline-dark" onclick="delete_product(this)">Удалить</div>
            </a>

        </td>
    </tr>
    <?php
    }
    ?>
</tbody>
