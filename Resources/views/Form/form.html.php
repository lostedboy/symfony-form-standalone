<?php echo $view['form']->start($form) ?>
    <fieldset layout="horizontal">
        <div class="panel-heading">General</div>
        <div class="panel-body">
            <?php echo $view['form']->widget($form) ?>
        </div>
    </fieldset>
<?php echo $view['form']->end($form) ?>
