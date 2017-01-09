
<?php if($paginator->hasPages()): ?>

    <ul class="pagination pagination-gap">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled"><a class="page-link">&laquo;</a></li>
        <?php else: ?>
            <li  class="page-item"><a  class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&laquo;</a></li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="page-item disabled"><a class="page-link"><?php echo e($element); ?></a></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="active page-item"><a class="page-link" ><?php echo e($page); ?></a></li>
                    <?php else: ?>
                        <li class="page-item"><a  class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">&raquo;</a></li>
        <?php else: ?>
            <li class="page-item disabled"><a class="page-link">&raquo;</a></li>
        <?php endif; ?>
    </ul>
	
<?php endif; ?>
