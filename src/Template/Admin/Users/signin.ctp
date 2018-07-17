<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>


 <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="javascript:void(0)" class="logo"><img src="<?php echo $this->request->getAttribute("webroot"); ?>images/logo-cpos.png"></a>
                <h5 class="m-t-0">A Complete cloud solution for your restaurant customer and order management to delivery</h5>
            </div>
        	<div class="m-t-40 card-box">
			
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
                </div>
                <div class="panel-body">
				<div class="hide">
				 <?php echo $this->Flash->render(); ?>
				</div> 
				<?php echo $this->Form->create('',['class'=>'form-horizontal m-t-20']); ?>
					 <div class="form-group ">
                       <div class="col-xs-12">
							<?php echo $this->Form->control('email',array('class'=>'form-control uname','label'=>false,'placeholder'=>"Email Address",'required'=>true)); ?>
						</div>
					</div>
					 <div class="form-group">
						<div class="col-xs-12">
							<?php echo $this->Form->control('password',array('class'=>'form-control pword','label'=>false,'placeholder'=>"Password",'required'=>true)); ?>
						</div>
					</div>
                    <?php echo $this->Flash->render('error'); ?>
					
					<div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
						<?php echo $this->Form->button('Sign In',array('class'=>'btn btn-danger btn-bordred btn-block waves-effect waves-light')); ?>  
						</div>
                    </div>
						<!--<div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a href="javasscript:void(0)" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div>-->
                <?php echo $this->Form->end(); ?>
                </div>
            </div>  
        </div>