<?php $date = Carbon\Carbon::yesterday()->format('Y-m-d'); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
   <loc><?php echo e(url('/'), false); ?></loc>
   <lastmod><?php echo e($date, false); ?></lastmod>
   <priority>0.8</priority>
</url>

<url>
  <loc><?php echo e(url('creators'), false); ?></loc>
  <lastmod><?php echo e($date, false); ?></lastmod>
  <priority>0.8</priority>
</url>

<url>
   <loc><?php echo e(url('contact'), false); ?></loc>
   <lastmod><?php echo e($date, false); ?></lastmod>
   <priority>0.8</priority>
 </url>

 <url>
    <loc><?php echo e(url('blog'), false); ?></loc>
    <lastmod><?php echo e($date, false); ?></lastmod>
    <priority>0.8</priority>
  </url>

  <?php $__currentLoopData = Blogs::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <url>
     <loc><?php echo e(url('blog/post', $post->id).'/'.$post->slug, false); ?></loc>
     <lastmod><?php echo e($date, false); ?></lastmod>
     <priority>0.8</priority>
  </url>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = Pages::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<url>
   <loc><?php echo e(url('p', $page->slug), false); ?></loc>
   <lastmod><?php echo e($date, false); ?></lastmod>
   <priority>0.8</priority>
</url>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php $__currentLoopData = Categories::where('mode', 'on')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<url>
  <loc><?php echo e(url('category', $category->slug), false); ?></loc>
  <lastmod><?php echo e($date, false); ?></lastmod>
  <priority>0.8</priority>
</url>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php $__currentLoopData = User::where('status','active')->where('verified_id', 'yes')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<url>
   <loc><?php echo e(url($user->username), false); ?></loc>
   <lastmod><?php echo e($date, false); ?></lastmod>
   <priority>0.8</priority>
</url>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

   <url>
      <loc><?php echo e(url('shop'), false); ?></loc>
      <lastmod><?php echo e($date, false); ?></lastmod>
      <priority>0.8</priority>
    </url>

    <?php $__currentLoopData = Products::where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <url>
     <loc><?php echo e(url('shop/product', $products->id), false); ?></loc>
     <lastmod><?php echo e($date, false); ?></lastmod>
     <priority>0.8</priority>
   </url>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</urlset>
<?php /**PATH /www/wwwroot/sensualinfluencers.com/resources/views/index/sitemaps.blade.php ENDPATH**/ ?>