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
                            <draggable v-model="form" v-bind="dragOptions" class="dragabble-form" @start="isDragging = true" @end="isDragging = false">
                                <div v-for="(data, index) in form">
                                    <!--option group (single service) start -->
                                    <div class="form-group"  v-if="data.field === 'opt_single_service'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <label for="clientName">{{ data.label }} <small v-if="data.isRequired == false">(optional)</small></label>
                                        <div class="form-row w-100" @click="editElementProperties(data)">
                                            <div class="col-md-6" v-for="(item, roll) in data.hasOptions" :key="item.optionValue" :label="roll">
                                                <div class="scard p-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="option0" id="action-0-0" class="custom-control-input" checked="checked"> 
                                                        <label for="action-0-0" class="custom-control-label">{{ item.serviceName }}</label> 
                                                        <p>{{ item.servicePrice }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- option group (single service) end -->


                                    <!-- Checkbox group (multiple services) start -->
                                    <div class="form-group" v-if="data.field === 'ckboxMultiServices'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <label for="clientName">{{ data.label }} <small v-show="data.isRequired == false">(optional)</small></label>
                                        <div class="form-row w-100" @click="editElementProperties(data)">
                                            <div class="col-md-6" v-for="(item, roll) in data.hasOptions" :key="item.optionValue" :label="roll">
                                                <div class="scard p-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="option1" :id="index" class="custom-control-input" checked="checked">
                                                        
                                                       <label :for="index" class="custom-control-label">{{ item.serviceName }}</label>
                                                        <p>{{ item.servicePrice }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Checkbox group (multiple services) end -->

                                    <!-- Dropdown menu (single service) start -->
                                    <div class="form-group" v-if="data.field === 'dropDownSingleService'" @click="formCustomize = dropDownSingleService" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
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
                                    <!-- Dropdown menu (single service) end -->


                                    <!-- Dropdown menu (multiple services) start -->
                                    <div class="form-group" v-if="data.field === 'dropDownMultipleServices'" @click="formCustomize = dropDownMultipleServices" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
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
                                    <!-- Dropdown menu (multiple services) end -->

                                    <!-- block two start -->
                                    <div class="form-group" v-if="data.field === 'fullName'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <label for="clientName"  @click="editElementProperties(data)">{{ data.label }}</label>
                                        <div class="form-row w-100" @click="editElementProperties(data)">
                                            <div class="col-md-6">
                                                <input type="text" name="name" class="form-control"  />
                                                <small>First Name</small>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="name" class="form-control"  />
                                                <small>Last Name</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="data.field === 'email'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <label :for="data.field">{{ data.label }}</label>
                                            <input id:="data.field" type="email" name="name" class="form-control" :placeholder="data.placeholder" />
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="data.field === 'password'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <label for="clientName">{{ data.label }}</label>
                                            <input type="password" class="form-control" :placeholder="data.placeholder" />
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="data.field === 'billingAddress'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <label :for="data.field">{{ data.label }}</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                        <input type="text" name="name" class="form-control"  />
                                                        <small>Address</small>
                                                </div>
                                                <div class="col-md-4">
                                                        <input type="text" name="name" class="form-control"  />
                                                        <small>City</small>
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="dropdown">
                                                        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle w-100 text-left" aria-expanded="false">
                                                                United States
                                                            <span class="bs-caret float-right"><span class="caret"></span></span>
                                                        </button> 
                                                        <div class="dropdown-menu w-100" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);"><a href="#" class="dropdown-item" draggable="false">United States</a>
                                                        </div>
                                                        <small>Country</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="name" class="form-control"  />
                                                    <small>State / Province / Region</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="name" class="form-control"  />
                                                    <small>Postal Code</small>
                                                </div>
                                                <div class="col-md-12 pt-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="action-2" class="custom-control-input"> 
                                                        <label for="action-2" class="custom-control-label">I'm purchasing for a company</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="data.field === 'email_option'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div class="custom-control custom-checkbox" @click="editElementProperties(data)">
                                            <input type="checkbox" id="action-3" class="custom-control-input"> 
                                            <label for="action-3" class="custom-control-label">{{ data.label }}</label> 
                                            <p class="help-block" v-if="data.helpBlock != null">{{ data.helpBlock }}</p>
                                        </div>
                                    </div>
                                    <!-- block two end -->
                                    <!-- block three start -->
                                    <div class="form-group" v-if="data.field === 'paymentMethod'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <label>{{ data.label }}</label>
                                        </div>
                                    </div>
                                    <!-- block three end -->

                                        

                                    <!-- single line of text start -->
                                    <div class="form-group" v-if="data.field === 'singleText'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div class=" w-100" @click="editElementProperties(data)">
                                            <label for="clientName">{{ data.label }} <small v-show="data.isRequired == false">(optional)</small></label>
                                            <input type="text" class="form-control" :placeholder="data.placeholder"  />
                                            <p>{{ data.helpBlock }}</p>
                                        </div>
                                    </div>
                                    <!-- single line of text end -->


                                    <!-- Multiple line of text start -->
                                    <div class="form-group" v-if="data.field === 'multiText'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <label for="clientName">{{ data.label }} <small v-show="data.isRequired == false">(optional)</small></label>
                                            <textarea class="form-control" spellcheck="false" :placeholder="data.placeholder"></textarea>
                                            <p>{{ data.helpBlock }}</p>
                                        </div>
                                    </div>
                                    <!-- Multiple line of text end -->


                                    <!-- Checkbox start -->
                                    <div class="form-group" v-if="data.field === 'checkbox'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                        <div class="custom-control custom-checkbox" @click="editElementProperties(data)">
                                            <input type="checkbox" id="action-2" class="custom-control-input"> 
                                            <label for="action-2" class="custom-control-label">{{ data.label }}</label> 
                                            <p>{{ data.helpBlock }}</p>
                                        </div>
                                    </div>
                                    <!-- Checkbox end -->

                                    <!-- dropdown start -->
                                    <div class="form-group" v-if="data.field === 'dropdown'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <label for="clientName">{{ data.label }} <small v-show="data.isRequired == false">(optional)</small></label>
                                            <div class="dropdown">
                                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle w-100 text-left" aria-expanded="false">{{ data.hasOptions[0].option }}
                                                    <span class="bs-caret float-right">
                                                        <span class="caret"></span>
                                                    </span>
                                                </button> 
                                                <div class="dropdown-menu w-100" x-placement="bottom-start" style="">
                                                    <a href="#" class="dropdown-item" draggable="false" v-for="(item, roll) in data.hasOptions" :key="item.optionValue" :label="roll">{{ item.option }}</a> 
                                                   
                                                </div>
                                            </div>
                                            <p>{{ data.helpBlock }}</p>
                                        </div>
                                    </div>
                                    <!-- dropdown end -->

                                    <!-- file upload start -->
                                    <div class="form-group" v-if="data.field === 'fileUpload'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <label for="clientName">{{ data.label }} <small v-show="data.isRequired == false">(optional)</small></label>
                                            <div class="custom-file">

                                                <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="validatedCustomFile">{{ data.placeholder }}</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                                <p v-if="data.helpblock != ''">{{ data.helpBlock }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- file upload end -->

                                    <!-- spread Sheet start -->
                                    <div class="form-group" v-if="data.field === 'spreadSheetInput'">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(field, index)"><i class="fas fa-trash"></i></button>
                                        <label>Spreadsheet input</label>
                                        <table class="slick-preview">
                                            <tr>
                                                <th>&nbsp;</th> 
                                                <th>Link</th>
                                                <th>Anchor text</th>
                                                <th>Test</th>
                                            </tr> 
                                            <tr>
                                                <th>1</th> 
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- spread Sheet start -->

                                    <!-- section break start -->
                                    <div class="form-group" v-if="data.field === 'sectionBreak'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <p class="mb-0" @click="editElementProperties(data)">{{ data.helpBlock }}</p>
                                    </div>
                                    <!-- section break end -->

                                    <!-- page break start -->
                                    <div class="form-group" v-if="data.field === 'pageBreak'" :class="{ 'is-active': data === activeForm  }">
                                        <button type="button" data-delete="" class="btn btn-sm remove-input" @click.prevent="clearField(data.field, index)"><i class="fas fa-trash"></i></button>
                                        <div @click="editElementProperties(data)">
                                            <button type="button" class="btn btn-success pl-5 pr-5 disabled">Next</button>
                                            <p class="mb-0 mt-2">{{ data.helpBlock }}</p>
                                        </div>
                                    </div>
                                    <!-- page break end -->
                                </div>
                            </draggable>
                            <button type="submit" class="mb-4 mt-1 mr-1 btn btn-primary ml-4"><i class="fas fa-plus"></i> Save form</button>
                        </div>
                    </div><!-- /. dragable-form left -->
                    <div class="col-lg-4">
                        <div class="sticky-top">
                            <div  v-show="elementInput === true">
                               <div class="list-group mb-3 available-fields">
                                    <button type="button" class="list-group-item list-group-item-action" @click="ckBoxSingleService" >
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
                                    <button type="button" class="list-group-item list-group-item-action" @click="fullName" >
                                        <i class="fas fa-user"></i> 
                                        <span class="ml-2">Full name</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="email">
                                        <i class="fas fa-envelope-open"></i> 
                                        <span class="ml-2">Email</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="password">
                                        <i class="fas fa-unlock-alt"></i> 
                                        <span class="ml-2">Password</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="billingAddress">
                                        <i class="fas fa-address-card"></i> 
                                        <span class="ml-2">Billing address</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="email_option">
                                        <i class="fas fa-envelope-open"></i> <span class="ml-2">Email Opt-in</span>
                                    </button>
                                </div>
                                <div class="list-group mb-3 available-fields">
                                    <button type="button" class="list-group-item list-group-item-action" @click="paymentMethod">
                                        <i class="fas fa-credit-card"></i> <span class="ml-2">Payment Method</span>
                                    </button>
                                </div>
                                <div class="list-group mb-3 available-fields">
                                    <button type="button" class="list-group-item list-group-item-action" @click="singleText(true)">
                                        <i class="fas fa-i-cursor"></i> 
                                        <span class="ml-2">Single line of text</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="multiText">
                                        <i class="fas fa-align-left"></i> 
                                        <span class="ml-2">Multiple lines of text</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="checkbox">
                                        <i class="fas fa-check-square"></i> 
                                        <span class="ml-2">Checkbox</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="dropdown">
                                        <i class="fas fa-sort"></i> 
                                        <span class="ml-2">Dropdown menu</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="fileUpload">
                                        <i class="fas fa-upload"></i>
                                        <span class="ml-2">File upload</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="spreadSheetInput">
                                        <i class="fas fa-table"></i> 
                                        <span class="ml-2">Spreadsheet input</span>
                                    </button>
                                </div>
                                <div class="list-group mb-3 available-fields">
                                    <button type="button" class="list-group-item list-group-item-action" @click="sectionBreak">
                                        <i class="fas fa-minus"></i> 
                                        <span class="ml-2">Section break</span>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action" @click="pageBreak">
                                        <i class="fas fa-clone"></i> 
                                        <span class="ml-2">Page break</span>
                                    </button>
                                </div>
                            </div>
                            <div v-show="elementInput === false">
                                <div class="card sticky-top edit-field">
                                    
                                   <div class="card-header">
                                      Edit
                                      <code>{{  activeForm.field }} </code> <a class="close float-right" @click="fieldCardClose">×</a>
                                   </div>
                                   <div class="card-body">
                                      <div class="form-group">
                                        <label>Field name</label> 
                                        <input type="text" v-model="activeForm.label" :placeholder="activeForm.label" class="form-control">
                                      </div>
                                      <!----> <!----> <!---->
                                      <div class="form-group" v-show="activeForm.hasOwnProperty('placeholder')">
                                         <label>Placeholder text</label> 
                                         <input type="text" v-model="activeForm.placeholder" class="form-control"> 
                                         <p class="help-block">Shown inside the field</p>
                                      </div>
                                      <!----> <!----> <!----> <!---->
                                      <div class="form-group" v-if="activeForm.hasOwnProperty('hasOptions') & activeForm.field != 'dropdown'">
                                        <label>Services</label>
                                        <div class="d-flex align-items-start justify-content-center service-add" v-if="activeForm['hasOwnProperty'].length">
                                            <select class="form-control">
                                                    <option disabled="true" selected>Please select a services</option>
                                                    <option v-for="(service, activeIndex) in activeForm.hasOptions" :key="activeIndex">{{ service.serviceName }}</option>
                                            </select>
                                            <button type="button" class="btn btn-sm remove" style=""><i class="fas fa-trash" @click="deleteOption(activeForm.hasOptions, activeIndex)"></i></button>
                                        </div>
                                        <div class="service-none" v-else>
                                            All services
                                        </div>
                                        <button type="button" class="btn btn-link p-0" @click="addOption(activeForm.hasOptions)">+ Add service</button>
                                      </div> 


                                      <div class="form-group" v-if="activeForm.hasOwnProperty('hasOptions') & activeForm.field == 'dropdown'">
                                        <label>Items</label>
                                        <div class="form-group">
                                            <div class="d-flex itemRemove" v-for="(item, activeIndex) in activeForm.hasOptions" :key="activeIndex" style="margin-bottom:10px">
                                                <input type="text" v-model="item.option" class="form-control" >
                                                <button type="button" class="btn btn-sm remove" @click="deleteOption(activeForm.hasOptions,activeIndex)" v-show="activeForm.hasOptions.length > 1">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-link p-0" @click="addOption(activeForm.hasOptions)">+ Add item</button>
                                      </div>
                                      <!----> <!----> <!----> <!----> 
                                      <div class="form-group" v-show="activeForm.hasOwnProperty('helpBlock')">
                                         <label>Help Text</label> 
                                         <textarea placeholder="Enter your full URL and anchor text" class="form-control" style="resize: none; overflow: hidden; height: 55px;" spellcheck="false" v-model="activeForm.helpBlock" ></textarea>
                                         <p class="help-block">Shown next to the field, supports HTML</p>
                                      </div>
                                      <!----> <!----> <!----> <!---->
                                      <div class="form-group" v-show="activeForm.hasOwnProperty('allowMultiple')">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="required" value="true" class="custom-control-input" v-model="activeForm.allowMultiple"> 
                                            <label for="required" class="custom-control-label">Allow multiple files</label>
                                        </div>
                                      </div>
                                      <div class="form-group" v-show="activeForm.hasOwnProperty('isRequired')">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="required1" value="true" class="custom-control-input" v-model="activeForm.isRequired"> 
                                            <label for="required1" class="custom-control-label">This is a required field</label>
                                        </div>
                                      </div>
                                      <!----> <!----> <!----> <!----> 
                                      <div class="text-right"><button type="button" class="btn btn-secondary" @click="fieldCardClose">Close</button></div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /. dragable-form right -->
                </div>
                <!-- dragable-form wrap end-->
            </form>

    </div>

</template>

 



<script>
    import draggable from "vuedraggable";
    export default {
        data () {
            return {
                form: [],
                elementInput:true,
                activeForm:[],
            }
        },
        methods: {
            sort() {
              this.form = this.form.sort((a, b) => a.order - b.order);
            },
            ckBoxSingleService () {
                this.form.push({
                    field: 'opt_single_service',
                    order:1,
                    label: 'Option group (single service)',
                    hasOptions: [
                        { serviceName: "Service 1", servicePrice: 100 },
                        { serviceName: "Service 2", servicePrice: 500 }
                    ],
                });

            
            },


     
            ckBoxMultipleService () {
                this.form.push({
                    field: 'ckboxMultiServices',
                    order:2,
                    label: 'Checkbox group (multiple services)',
                    isRequired:false,
                    hasOptions: [
                        { serviceName: "Service 1", servicePrice: 100 },
                        { serviceName: "Service 2", servicePrice: 500 }
                    ],
                })
            },
            dropDownSingle () {
                this.form.push({
                    field: 'dropDownSingleService',
                     order:3,
              
                })
            },
            dropDownMultiple () {
                this.form.push({
                    field: 'dropDownMultipleServices',
                     order:4,
          
                })
            },
            //2nd box
            fullName() {
                this.form.push({
                    field: 'fullName',
                    order:5,
                    label: 'Full Name',
                })
            },
            email() {
                this.form.push({
                    field: 'email',
                    order:6,
                    label: 'Email',
                    placeholder: '',
                })
            },
            password() {
                this.form.push({
                    field: 'password',
                    order:7,
                    label: 'Password',
                    placeholder: '',
                })
            },
            billingAddress() {
                this.form.push({
                    field: 'billingAddress',
                    order:8,
                    label: 'Billing Address',
                })
            },
            email_option() {
                this.form.push({
                    field: 'email_option',
                    order:9,
                    label: 'Email Opt-in',
                    helpBlock:'Check this box if you\'d like to receive occasional emails from us',

                })
            },
            paymentMethod() {
                this.form.push({
                    field: 'paymentMethod',
                    order:10,
                    label: 'Payment Method',
                })
            },
            //last part
            singleText() {
                this.form.push({
                    field: 'singleText',
                    order:11,
                    label:'Single line of text',
                    helpBlock:'',
                    isRequired:false,
                    placeholder:'',

                })
            },
            multiText() {
                this.form.push({
                    field: 'multiText',
                    order:12,
                    label:'Multiple lines of text',
                    helpBlock:'',
                    isRequired:false,
                    placeholder:'',
                })
            },
            checkbox() {
                this.form.push({
                    field: 'checkbox',
                    order:13,
                    label:'Checkbox',
                    helpBlock:'',
                    isRequired:false,
                })
            },
            dropdown() {
                this.form.push({
                    field: 'dropdown',
                    order:14,
                    label:'Dropdown menu',
                    helpBlock:'',
                    isRequired:false,
                    hasOptions: [
                        { option: "Option 1"},
                        { option: "Option 2"}
                    ],
                })
            },
            fileUpload() {
                this.form.push({
                    field: 'fileUpload',
                    order:15,
                    label:'File Upload',
                    placeholder:'Choose file...',
                    helpBlock:'',
                    isRequired:false,
                    allowMultiple:false,
                })
            },
            spreadSheetInput() {
                this.form.push({
                    field: 'spreadSheetInput',
                    order:16,
                })
            },
            sectionBreak(){
                this.form.push({
                    field:'sectionBreak',
                    order:17,
                })
            },
            pageBreak(){
                this.form.push({
                    field:'pageBreak',
                    order:18,
                    label:'Page Break',
                    helpBlock:'Decribe the page below or leve empty'
                })
            },
            //clear field
            clearField (field, index) {
                this.form.splice(index, 1);
                this.fieldCardClose();
            },
            clearForm () {
                this.form = []
            },

            //field close
            fieldCardClose() {
                this.elementInput = true;
            },

            editElementProperties(form){
                this.elementInput = false;
                this.activeForm = form;
            },

            //add and delete new array inside an exixting object
            deleteOption(option, index){
                this.$delete(option, index)
            },
            addOption(option){
                let count = option.length + 1;

                option.push({
                    serviceName: "Option " + count,
                    servicePrice: "1" + count
                })
            }
      
        },
        computed: {
            dragOptions() {
              return {
                animation: 0,
                group: "description",
                disabled: false,
                ghostClass: "ghost"
              };
            }
        }
    }
</script>