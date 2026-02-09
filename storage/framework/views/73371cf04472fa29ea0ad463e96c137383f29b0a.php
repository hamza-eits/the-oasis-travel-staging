

<?php $__env->startSection('title', 'Users'); ?>
 

<?php $__env->startSection('content'); ?>

 <div class="main-content">

 <div class="page-content">
<div class="container-fluid">

 <!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
 <h4 class="mb-sm-0 font-size-18">Manage Users</h4>

 <div class="page-title-right">
<div class="page-title-right">

</div>
</div>
</div>
</div>
<div>
 <!-- end page title -->

 <?php if(session('error')): ?>

 <div class="alert alert-<?php echo e(Session::get('class')); ?> p-3">
                    
                   <?php echo e(Session::get('error')); ?>  
                </div>

<?php endif; ?>

 <?php if(count($errors) > 0): ?>
                                 
                            <div >
                <div class="alert alert-danger pt-3 pl-0   border-3">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                </div>
 
            <?php endif; ?>
<div class="row">
 <div class="col-12">
    <form action="<?php echo e(URL('/UpdatePassword')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

<div class="card">
<div class="card-body">

<h4 class="card-title">Update User</h4>
<p class="card-title-desc"></p>

 


<div class="mb-3 row">
<label for="example-email-input" class="col-md-2 col-form-label">Old Password</label>
<div class="col-md-10">
<input class="form-control" type="password"   name="old_password" id="example-email-input" value="<?php echo e(old('old_password')); ?>">
</div>
</div>
<div class="mb-3 row">
<label for="example-url-input" class="col-md-2 col-form-label">New Password</label>
<div class="col-md-10">
<input class="form-control" type="password"  name="new_password"  value="<?php echo e(old('new_password')); ?>"  >
</div>

</div>
<div class="mb-3 row">
<label for="example-url-input" class="col-md-2 col-form-label">New Confirm Password</label>
<div class="col-md-10">
<input class="form-control" type="password"  name="new_confirm_passowrd" value="<?php echo e(old('new_confirm_passowrd')); ?>"  >
</div>

</div>

<div class="mb-3 row">
<label for="example-url-input" class="col-md-2 col-form-label">  </label>
<div class="col-md-10">
   <input type="submit" class="btn btn-primary w-md" value="Change Password"  >  

    <a href="<?php echo e(URL('/Dashboard')); ?>" class="btn btn-secondary w-md">Cancel</a>  
</div>

</div>
 
 
                                      
                               
                                   
    
                                      
                                        

                                       

                                    </div>
                                </div>

                            </form>
                            </div> <!-- end col -->
                        </div>
                      

  
                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


    
</div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('template.tmp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u790884004/domains/xtbooks.cloud/public_html/bin_javed_pk/resources/views/change_password.blade.php ENDPATH**/ ?>