<div class="row">
    <div class="col-md-6">
        <p>PLUGIN LIST</p>
        <ol>
            <?php foreach ($pluginList as $name): ?>
                <li><?= $name; ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
    <div class="col-md-6">
        <p>MODULE LIST</p>
        <ol>
            <?php sort($moduleList); ?>
            <?php foreach ($moduleList as $name): ?>
                <li><?= $name; ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <p>EVENT MAP</p>
        <ol>
            <?php foreach ($eventMap as $event => $map): ?>
                <li><?= $event ?> => <?= count($map) ?> func</li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-10">
        <p>ROUTER MAP</p>
        <ol>
            <?php foreach ($routerMap as $method => $map): ?>
                <li><?= $method ?></li>
                <ol>
                    <?php ksort($map); ?>
                    <?php foreach ($map as $pathInfo => $action): ?>
                        <li><span
                                style="display:inline-block;width: 200px"><?= $pathInfo ?></span><?= is_string($action) ? $action : 'Closure' ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php endforeach; ?>
        </ol>
    </div>
</div>

