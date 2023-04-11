<?=view('front.layouts.header'); ?>
    <h1>Bloqlar</h1>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($blogs as $blog) : ?>
            <tr>
                <th scope="row"><?=$blog->id;?></th>
                <td><a href="<?=url('blog', ['id' => $blog->id]);?>"><?=$blog->title;?></a></td>
                <td><?=$blog->description;?></td>
                <td><?=$blog->status;?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?=view('front.layouts.footer'); ?>