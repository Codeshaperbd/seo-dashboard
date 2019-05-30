<template>

    <div class="dragabble-form-wrap">
            
            <form class="p-3" action="" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-lg-8 col-xl-8">
                        <div class="card-body mb-3">
                            <div class="form-top gradient-bg">
                                <h4 class="mb-3">Add form</h4>
                                <a href="#" class="btn btn-default" style="border: inset 2px #000000;color: #000;">View Form</a>
                            </div>
                            <div class="form-group">

                                <label for="clientName">Form name <span class="required">*</span></label>
                                <input type="text" id="clientName" name="clientName"  class="form-control" required placeholder="John Einarson" >

                            </div>

                            <div class="form-group">

                                <label for="password">Form information(Optional)</label>
                                <textarea name="form_info" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="checkbox-custom checkbox-primary">
                                    <input type="checkbox" checked="" id="sendNotification" value="1" name="sendNotification">
                                    <label for="sendNotification">Show coupon field</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- dragable-form wrap start-->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-body-2">
                            <div class="form-devider">
                                Drag and drop fields from the right column onto your form here...
                            </div>
                           
                            <div class="dragabble-form" v-for="(data, index) in form">

                                <!-- block one start -->
                                <div class="form-group" >
                                    <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                    <label for="clientName">Option group (single service)</label>
                                    <div class="form-row w-100">
                                        <div class="col-md-4">
                                            <div class="scard p-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="option0" id="action-0-0" class="custom-control-input" checked="checked"> 
                                                    <label for="action-0-0" class="custom-control-label">Service one</label> 
                                                    <p>$120.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" v-if="data.field === 'ckboxMultiServices'">
                                    <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                    <label for="clientName">Checkbox group (multiple services)</label>
                                    <div class="form-row w-100">
                                        <div class="col-md-4">
                                            <div class="scard p-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="option1" :id="index" class="custom-control-input" checked="checked">
                                                    
                                                   <label :for="index" class="custom-control-label">Service one</label>
                                                    <p>$120.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" v-if="data.field === 'dropDownSingleService'">
                                    <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                    <label for="clientName">Dropdown menu (single service)</label>
                                    <div class="dropdown">
                                        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle w-100 text-left" aria-expanded="false">Choose a service
                                            <span class="bs-caret float-right">
                                                <span class="caret"></span>
                                            </span>
                                        </button> 
                                        <div class="dropdown-menu w-100" x-placement="bottom-start" style="">
                                            <a href="#" class="dropdown-item" draggable="false">Choose a service</a> 
                                            <a href="#" click.prevent="1" class="dropdown-item" draggable="false">Service one</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" v-if="data.field === 'dropDownMultipleServices'">
                                    <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                    <label for="clientName">Dropdown menu (Multiple service)</label>
                                    <div class="dropdown">
                                        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle w-100 text-left" aria-expanded="false">Choose a service
                                            <span class="bs-caret float-right">
                                                <span class="caret"></span>
                                            </span>
                                        </button> 
                                        <div class="dropdown-menu w-100" x-placement="bottom-start" style="">
                                            <a href="#" class="dropdown-item" draggable="false">Choose a service</a> 
                                            <a href="#" click.prevent="1" class="dropdown-item" draggable="false">Service one</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- block one end -->


                                <!-- block two start -->

                                <!-- block two end -->

                                <!-- <div class="form-group" v-if="data.field === 'opt_single_service'">
                                    <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                    <label for="clientName">Form name <span class="required">*</span></label>
                                    <input type="text" id="clientName" name="clientName"  class="form-control" required placeholder="John Einarson">

                                </div> -->
                              
                            </div>
                            <button type="submit" class="mb-4 mt-1 mr-1 btn btn-primary ml-4"><i class="fas fa-plus"></i> Save form</button>
                        </div>
                    </div><!-- /. dragable-form left -->
                    <div class="col-lg-4">
                        <div class="sticky-top">
                           <div class="list-group mb-3 available-fields">
                                <button type="button" class="list-group-item list-group-item-action" @click="ckBoxSingleService">
                                    <i class="fas fa-dot-circle"></i> 
                                    <span class="ml-2">Option group (single service)</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action" @click="ckBoxMultipleService">
                                    <i class="fas fa-check"></i>
                                    <span class="ml-2">Checkbox group (multiple services)</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action" @click="dropDownSingle">
                                    <i class="fas fa-sort"></i> 
                                    <span class="ml-2">Dropdown menu (single service)</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action" @click="dropDownMultiple">
                                    <i class="fas fa-sort"></i> 
                                    <span class="ml-2">Dropdown menu (multiple services)</span>
                                </button>
                            </div>
                            <div class="list-group mb-3 available-fields">
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-user"></i> 
                                    <span class="ml-2">Full name</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-unlock-alt"></i> 
                                    <span class="ml-2">Password</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-address-card"></i> 
                                    <span class="ml-2">Billing address</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-envelope-open"></i> <span class="ml-2">Email Opt-in</span>
                                </button>
                            </div>
                            <div class="list-group mb-3 available-fields">
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-i-cursor"></i> 
                                    <span class="ml-2">Single line of text</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-align-left"></i> 
                                    <span class="ml-2">Multiple lines of text</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-check-square"></i> 
                                    <span class="ml-2">Checkbox</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-sort"></i> 
                                    <span class="ml-2">Dropdown menu</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-arrow-alt-from-bottom"></i> 
                                    <span class="ml-2">File upload</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-table"></i> 
                                    <span class="ml-2">Spreadsheet input</span>
                                </button>
                            </div>
                            <div class="list-group mb-3 available-fields">
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-minus"></i> 
                                    <span class="ml-2">Section break</span>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <i class="fas fa-clone"></i> 
                                    <span class="ml-2">Page break</span>
                                </button>
                            </div>
                        </div>
                    </div><!-- /. dragable-form right -->
                </div>
                <!-- dragable-form wrap end-->
            </form>

    </div>

</template>

 


<script>
    export default {
        data () {
            return {
                form: [],
            }
        },
        methods: {
             ckBoxSingleService () {
                this.form.push({
                     field: 'opt_single_service',
                })
            },
     
            ckBoxMultipleService () {
                this.form.push({
                    field: 'ckboxMultiServices',
                })
            },
            dropDownSingle () {
                this.form.push({
                    field: 'dropDownSingleService',
              
                })
            },
            dropDownMultiple () {
                this.form.push({
                    field: 'dropDownMultipleServices',
          
                })
            },
            //clear field
            clearField (field, index) {
                this.form.splice(index, 1);
            },
            clearForm () {
                this.form = []
            },
      
        }
    }
</script>