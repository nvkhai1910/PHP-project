<h2>Danh sách lời nhắn</h2>
<table class="table" border="1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Email</th>
            <th scope="col">Lời nhắn</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message) : ?>
            <tr>
                <th scope="row"><?php echo isset($message['id']) ? $message['id'] : ''; ?></th>
                <td><?php echo isset($message['name']) ? $message['name'] : ''; ?></td>
                <td><?php echo isset($message['email']) ? $message['email'] : ''; ?></td>
                <td><?php echo isset($message['message']) ? $message['message'] : ''; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>