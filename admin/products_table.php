<thead>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Options</th>
</thead>
<tbody>
<?php
    $sql = "SELECT * FROM categories";
    $result = $connect->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <tr >
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['cost']; ?> $</td>
        <td>
            <a class="btn-group" role="group" aria-label="Basic example">
                <a href="options/products/edit_products.php?id=<?php echo $row['id']; ?>"  class="btn btn-secondary">Edit</a>
                <div data-link="options/products/delete_product.php?id=<?php echo $row['id']; ?>"  class="btn btn-secondary" onclick="delete_product(this)">Delete</div>
            </div>

        </td>
    </tr>
    <?php
    }
    ?>
</tbody>