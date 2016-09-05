<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    1300 Support Claims <small>please make your claims here</small>
                </h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-reorder"></i> Claims Form -
                            <span class="step-title">
                                Step 1 of 3

                            </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="includes/process_form.php" class="form-horizontal" id="submit_form">
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number">
                                                    1
                                                </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Refund Details
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                                <span class="number">
                                                    2
                                                </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Address Details
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step">
                                                <span class="number">
                                                    3
                                                </span>
                                                <span class="desc">
                                                    <i class="fa fa-check"></i> Summary & Claim
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-success">
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button>
                                            Your form validation is successful!
                                        </div>
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="block">Refund Details</h3>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input type="hidden" class="form-control" name="mobile" value="<?php echo $row['caller_number']; ?>" readonly/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Ticket Id
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="ticket_id" value="<?php echo $row['ticket_id']; ?>" readonly/>
                                                    <span class="help-block">
                                                        Provide Ticket ID
                                                    </span>
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-control" name="e" value="<?php echo $row['eligible_amount']; ?>"/>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Amount
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="amount" value="<?php echo $row['propose_amount']; ?>" readonly/>
                                                    <span class="help-block">
                                                        Your amount Details
                                                    </span>
                                                </div>
                                            </div>

                                            <?php
                                            $advertisedNames = Utility::getAdvertisedNameList($row['ticket_id']);

                                            if (count($advertisedNames) > 1):
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Advertised Name
                                                        <span class="required">
                                                            *
                                                        </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="sms_service_short_code_id" required="required">
                                                            <option value="">Select Advertised name</option>
                                                            <?php foreach ($advertisedNames as $key => $value) : ?>
                                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <span class="help-block">
                                                            Select Advertised Name
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                            else :
                                                $default_sms_short_code = '';
                                                $sms_short_code = array_keys($advertisedNames);
                                                if (isset($sms_short_code[0])) {
                                                    $default_sms_short_code = $sms_short_code[0];
                                                }
                                                ?>
                                                <input type="hidden" name="sms_service_short_code_id" value="<?php echo $default_sms_short_code; ?>"/>
                                            <?php endif; ?>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Agreement
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <div class="checkbox-list">
                                                        <label>
                                                            <input type="checkbox" name="agreement" value="1" data-title="Yes, send me the refund."/>Yes, send me my refund asap. By submitting <a data-toggle="modal" href="#basic">[more ...]</a></label>
                                                    </div>
                                                    <div id="form_agreement_error">
                                                    </div>
                                                </div>            
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h3 class="block">Where do we send the cheque to ? Please provide your details ...</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Fullname
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="fullname"/>
                                                    <span class="help-block">
                                                        Please make sure your name is spelled exactly the same as it is in your bank account.
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Unit Number
                                                    <!--<span class="required">
                                                        *
                                                    </span>-->
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="unit"/>
                                                    <span class="help-block">
                                                        Provide your unit number
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Street Number
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="street_no"/>
                                                    <span class="help-block">
                                                        Provide your street number
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Street
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="street"/>
                                                    <span class="help-block">
                                                        Provide your street
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Suburb
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="suburb"/>
                                                    <span class="help-block">
                                                        Provide your suburb														</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">State
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="state"/>
                                                    <span class="help-block">
                                                        Provide your state</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Postcode
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="postcode"/>
                                                    <span class="help-block">
                                                        Provide your post code</span>
                                                </div>
                                            </div>                                            

                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <h3 class="block">Summary of your claim</h3>
                                            <!--<h4 class="form-section">Mobile Number</h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Mobile</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="mobile" id="mobile">
                                                    </p>
                                                </div>
                                            </div>-->
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Ticket</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="ticket_id" id="ticket_id">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Amount</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="amount" id="amount">
                                                    </p>
                                                </div>
                                            </div>
                                            <h4 class="form-section">Address</h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Fullname</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="fullname" id="fullname">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Unit</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="unit" id="unit">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Street No</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="street_no" id="street_no">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Street</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="street" id="street">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Suburb:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="suburb" id="suburb">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">State:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="state" id="state">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Postcode</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="postcode" id="postcode">
                                                    </p>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn default button-previous">
                                                    <i class="m-icon-swapleft"></i> Back </a>
                                                <a href="javascript:;" class="btn blue button-next">
                                                    Continue <i class="m-icon-swapright m-icon-white"></i>
                                                </a>
                                                <a href="javascript:;" class="btn green button-submit">
                                                    Submit & Claim<i class="m-icon-swapright m-icon-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>

<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Yes, send me my cheque. By accepting and submitting this refund claim I acknowledge the satisfactory outcome of the negotiations made, and I confirm that I will not escalate matters that relate to this negotiation with my telecommunications provider or any other body.</p>
                <p>By accepting this resolution and the financial compensation, I will not be entitled to any further (future) negotiations, settlements or any other (financial) compensation for usage of the Premium service(s) related to this negotiation.</p>
                <p>I agree that I will refrain from further usage of this premium service.</p>
                <p>I acknowledge that I have been informed that I can ask my telephony provider to bar access to 19x/Premium services.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Ok</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

