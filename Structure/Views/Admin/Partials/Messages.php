<a href="javascript:void(0)" data-toggle="dropdown">
    <i class="mdi mdi-email-outline"></i>
    <?php $messages = falseToArray($messages); ?>
    <?php if(count($messages) > 0): ?>
    <span class="badge badge-pill gradient-1"><?php echo count($messages); ?></span>
    <?php endif; ?>
</a>
<div class="drop-down animated fadeIn dropdown-menu">
        <?php if(count($messages) > 1): ?>
        <div class="dropdown-content-heading d-flex justify-content-between">
            <span class=""><?php echo count($messages). " " .scr('new-messages'); ?></span>
            <a href="<?php au('messages'); ?>" class="d-inline-block">
                <?php sc('see-all-messages'); ?>
                <span class="badge badge-pill gradient-1"><?php echo count($messages); ?></span>
            </a>
            <span class="badge badge-pill gradient-1"></span>
        </div>
    <?php endif; ?>
    <div class="dropdown-content-body">
        <ul>
            <?php if (count($messages) > 1): ?>
            <?php foreach ($messages as $message): ?>
            <li class="notification-unread">
                <a href="<?php au('messageDetail/'.$message["ID"]); ?>">
                    <img class="float-left mr-3 avatar-img" src="<?php assets('Admin/images/avatar/'. rand(1, 8) .'.jpg'); ?>" alt="">
                    <div class="notification-content">
                        <div class="notification-heading"><?php echo security($message["Name"]); ?></div>
                        <div class="notification-timestamp"><?php echo trDate($message["PostDate"]); ?></div>
                        <div class="notification-text"><?php echo security(characterLimiter($message["Name"], 33, "...")); ?></div>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
            <h6><?php sc('no-messages'); ?></h6>
            <?php endif; ?>
        </ul>

    </div>
</div>