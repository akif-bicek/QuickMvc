<div class="nk-nav-scroll">
    <ul class="metismenu" id="menu">
        <?php foreach ($sidebar as $key => $menu): ?>
            <?php if (is_int($key)): ?>
                <li class="nav-label"><?php sc($menu); ?></li>
            <?php elseif(is_string($menu["pages"])): ?>
            <li>
                <a href="<?php au($menu["pages"]); ?>">
                    <i class="fa fa-<?php echo $menu["icon"]; ?>"></i>
                    <span class="nav-text"><?php sc($key); ?></span>
                </a>
            </li>
            <?php elseif(is_array($menu["pages"])): ?>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-<?php echo $menu["icon"]; ?> menu-icon"></i><span class="nav-text"><?php sc($key); ?></span>
                    </a>
                    <ul aria-expanded="false">
                        <?php foreach($menu["pages"] as $page => $link): ?>
                        <li><a href="<?php au($link); ?>"><?php sc($page); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>