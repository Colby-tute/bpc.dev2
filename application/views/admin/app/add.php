<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <?= $header; ?>
        <div class="container">
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">User Add Details</h4>
                           <!--  <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
                                </ol>
                            </nav> -->

                        </div>
                        <div class="my-auto breadcrumb-right">
                            <!-- <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
                            <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button> -->
                            <a class="btn btn-success mr-0" href="<?= site_url('admin/user') ?>"><span class="icon-label"></span><span class="btn-text">Back </span></a>
                        </div>
                    </div>

                    <div class="">
                        <!-- row opened -->
                        <div class="row row-sm">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <?php if ($this->session->flashdata('danger')) { ?>
                                             <div id="infoMessage" class="alert alert-danger" style="margin-top: 25px;"><?php echo $this->session->flashdata('danger');?></div>
                                        <?php } ?>
                                        <?php echo form_open_multipart("admin/user/User/add", 'class="login" data-toggle="validator"'); ?>
                                        <div id="companyform">
                                            <div class="col-md-12"> 
                                                    <div class="row">
                                                        <div id="error_msg"></div>
                                                        <div class="col-md-12 form-group mb-3">
                                                                <label for="firstName1">Role*</label>
                                                                <select name="tbl_users_role_id" class="form-control js-example-basic-single" id="tbl_users_role_id">
                                                                    <option value="">Select</option>
                                                                    <?php foreach ($role as $key => $ro){
                                                                        ?>
                                                                        <option value="<?php echo $ro->tbl_roles_id; ?>"><?php echo $ro->tbl_roles_title; ?></option>
                                                                        
                                                                    <?php } ?>
                                                                </select>
                                                               
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">First Name</label>
                                                            <input type="text" name="tbl_users_firstname" class="form-control" id="tbl_users_firstname" placeholder="First Name" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">Last Name</label>
                                                            <input type="text" name="tbl_users_lastname" class="form-control" id="tbl_users_lastname" placeholder="Last Name" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="exampleInputEmail1">Email*</label>
                                                            <input type="email" name="tbl_users_email" class="form-control" id="tbl_users_email"  placeholder="Enter your Email Address" />
                                                            <span></span>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="credit1">Password*</label>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <input type="text" name="tbl_users_password" class="form-control" id="password" minlength="8" title="Password should have atleast 8 Character"  placeholder="Enter your Password" />
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" name="generatepass" id="generatepass" class="btn btn-success"><i class="typcn typcn-arrow-shuffle"></i></button> 
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-6 form-group mb-3"> 
                                                            <label for="credit1">Mobile No*</label>
                                                            <div class="row">
                                                                <div class="col-md-2"><?php
                                                                    $array = 
                                                                    [
                                                                            '44' => 'UK (+44)',
                                                                            '1' => 'USA (+1)',
                                                                            '213' => 'Algeria (+213)',
                                                                            '376' => 'Andorra (+376)',
                                                                            '244' => 'Angola (+244)',
                                                                            '1264' => 'Anguilla (+1264)',
                                                                            '1268' => 'Antigua & Barbuda (+1268)',
                                                                            '54' => 'Argentina (+54)',
                                                                            '374' => 'Armenia (+374)',
                                                                            '297' => 'Aruba (+297)',
                                                                            '61' => 'Australia (+61)',
                                                                            '43' => 'Austria (+43)',
                                                                            '994' => 'Azerbaijan (+994)',
                                                                            '1242' => 'Bahamas (+1242)',
                                                                            '973' => 'Bahrain (+973)',
                                                                            '880' => 'Bangladesh (+880)',
                                                                            '1246' => 'Barbados (+1246)',
                                                                            '375' => 'Belarus (+375)',
                                                                            '32' => 'Belgium (+32)',
                                                                            '501' => 'Belize (+501)',
                                                                            '229' => 'Benin (+229)',
                                                                            '1441' => 'Bermuda (+1441)',
                                                                            '975' => 'Bhutan (+975)',
                                                                            '591' => 'Bolivia (+591)',
                                                                            '387' => 'Bosnia Herzegovina (+387)',
                                                                            '267' => 'Botswana (+267)',
                                                                            '55' => 'Brazil (+55)',
                                                                            '673' => 'Brunei (+673)',
                                                                            '359' => 'Bulgaria (+359)',
                                                                            '226' => 'Burkina Faso (+226)',
                                                                            '257' => 'Burundi (+257)',
                                                                            '855' => 'Cambodia (+855)',
                                                                            '237' => 'Cameroon (+237)',
                                                                            '1' => 'Canada (+1)',
                                                                            '238' => 'Cape Verde Islands (+238)',
                                                                            '1345' => 'Cayman Islands (+1345)',
                                                                            '236' => 'Central African Republic (+236)',
                                                                            '56' => 'Chile (+56)',
                                                                            '86' => 'China (+86)',
                                                                            '57' => 'Colombia (+57)',
                                                                            '269' => 'Comoros (+269)',
                                                                            '242' => 'Congo (+242)',
                                                                            '682' => 'Cook Islands (+682)',
                                                                            '506' => 'Costa Rica (+506)',
                                                                            '385' => 'Croatia (+385)',
                                                                            '53' => 'Cuba (+53)',
                                                                            '90392' => 'Cyprus North (+90392)',
                                                                            '357' => 'Cyprus South (+357)',
                                                                            '42' => 'Czech Republic (+42)',
                                                                            '45' => 'Denmark (+45)',
                                                                            '253' => 'Djibouti (+253)',
                                                                            '1809' => 'Dominica (+1809)',
                                                                            '1809' => 'Dominican Republic (+1809)',
                                                                            '593' => 'Ecuador (+593)',
                                                                            '20' => 'Egypt (+20)',
                                                                            '503' => 'El Salvador (+503)',
                                                                            '240' => 'Equatorial Guinea (+240)',
                                                                            '291' => 'Eritrea (+291)',
                                                                            '372' => 'Estonia (+372)',
                                                                            '251' => 'Ethiopia (+251)',
                                                                            '500' => 'Falkland Islands (+500)',
                                                                            '298' => 'Faroe Islands (+298)',
                                                                            '679' => 'Fiji (+679)',
                                                                            '358' => 'Finland (+358)',
                                                                            '33' => 'France (+33)',
                                                                            '594' => 'French Guiana (+594)',
                                                                            '689' => 'French Polynesia (+689)',
                                                                            '241' => 'Gabon (+241)',
                                                                            '220' => 'Gambia (+220)',
                                                                            '7880' => 'Georgia (+7880)',
                                                                            '49' => 'Germany (+49)',
                                                                            '233' => 'Ghana (+233)',
                                                                            '350' => 'Gibraltar (+350)',
                                                                            '30' => 'Greece (+30)',
                                                                            '299' => 'Greenland (+299)',
                                                                            '1473' => 'Grenada (+1473)',
                                                                            '590' => 'Guadeloupe (+590)',
                                                                            '671' => 'Guam (+671)',
                                                                            '502' => 'Guatemala (+502)',
                                                                            '224' => 'Guinea (+224)',
                                                                            '245' => 'Guinea - Bissau (+245)',
                                                                            '592' => 'Guyana (+592)',
                                                                            '509' => 'Haiti (+509)',
                                                                            '504' => 'Honduras (+504)',
                                                                            '852' => 'Hong Kong (+852)',
                                                                            '36' => 'Hungary (+36)',
                                                                            '354' => 'Iceland (+354)',
                                                                            '91' => 'India (+91)',
                                                                            '62' => 'Indonesia (+62)',
                                                                            '98' => 'Iran (+98)',
                                                                            '964' => 'Iraq (+964)',
                                                                            '353' => 'Ireland (+353)',
                                                                            '972' => 'Israel (+972)',
                                                                            '39' => 'Italy (+39)',
                                                                            '1876' => 'Jamaica (+1876)',
                                                                            '81' => 'Japan (+81)',
                                                                            '962' => 'Jordan (+962)',
                                                                            '7' => 'Kazakhstan (+7)',
                                                                            '254' => 'Kenya (+254)',
                                                                            '686' => 'Kiribati (+686)',
                                                                            '850' => 'Korea North (+850)',
                                                                            '82' => 'Korea South (+82)',
                                                                            '965' => 'Kuwait (+965)',
                                                                            '996' => 'Kyrgyzstan (+996)',
                                                                            '856' => 'Laos (+856)',
                                                                            '371' => 'Latvia (+371)',
                                                                            '961' => 'Lebanon (+961)',
                                                                            '266' => 'Lesotho (+266)',
                                                                            '231' => 'Liberia (+231)',
                                                                            '218' => 'Libya (+218)',
                                                                            '417' => 'Liechtenstein (+417)',
                                                                            '370' => 'Lithuania (+370)',
                                                                            '352' => 'Luxembourg (+352)',
                                                                            '853' => 'Macao (+853)',
                                                                            '389' => 'Macedonia (+389)',
                                                                            '261' => 'Madagascar (+261)',
                                                                            '265' => 'Malawi (+265)',
                                                                            '60' => 'Malaysia (+60)',
                                                                            '960' => 'Maldives (+960)',
                                                                            '223' => 'Mali (+223)',
                                                                            '356' => 'Malta (+356)',
                                                                            '692' => 'Marshall Islands (+692)',
                                                                            '596' => 'Martinique (+596)',
                                                                            '222' => 'Mauritania (+222)',
                                                                            '269' => 'Mayotte (+269)',
                                                                            '52' => 'Mexico (+52)',
                                                                            '691' => 'Micronesia (+691)',
                                                                            '373' => 'Moldova (+373)',
                                                                            '377' => 'Monaco (+377)',
                                                                            '976' => 'Mongolia (+976)',
                                                                            '1664' => 'Montserrat (+1664)',
                                                                            '212' => 'Morocco (+212)',
                                                                            '258' => 'Mozambique (+258)',
                                                                            '95' => 'Myanmar (+95)',
                                                                            '264' => 'Namibia (+264)',
                                                                            '674' => 'Nauru (+674)',
                                                                            '977' => 'Nepal (+977)',
                                                                            '31' => 'Netherlands (+31)',
                                                                            '687' => 'New Caledonia (+687)',
                                                                            '64' => 'New Zealand (+64)',
                                                                            '505' => 'Nicaragua (+505)',
                                                                            '227' => 'Niger (+227)',
                                                                            '234' => 'Nigeria (+234)',
                                                                            '683' => 'Niue (+683)',
                                                                            '672' => 'Norfolk Islands (+672)',
                                                                            '670' => 'Northern Marianas (+670)',
                                                                            '47' => 'Norway (+47)',
                                                                            '968' => 'Oman (+968)',
                                                                            '680' => 'Palau (+680)',
                                                                            '507' => 'Panama (+507)',
                                                                            '675' => 'Papua New Guinea (+675)',
                                                                            '595' => 'Paraguay (+595)',
                                                                            '51' => 'Peru (+51)',
                                                                            '63' => 'Philippines (+63)',
                                                                            '48' => 'Poland (+48)',
                                                                            '351' => 'Portugal (+351)',
                                                                            '1787' => 'Puerto Rico (+1787)',
                                                                            '974' => 'Qatar (+974)',
                                                                            '262' => 'Reunion (+262)',
                                                                            '40' => 'Romania (+40)',
                                                                            '7' => 'Russia (+7)',
                                                                            '250' => 'Rwanda (+250)',
                                                                            '378' => 'San Marino (+378)',
                                                                            '239' => 'Sao Tome & Principe (+239)',
                                                                            '966' => 'Saudi Arabia (+966)',
                                                                            '221' => 'Senegal (+221)',
                                                                            '381' => 'Serbia (+381)',
                                                                            '248' => 'Seychelles (+248)',
                                                                            '232' => 'Sierra Leone (+232)',
                                                                            '65' => 'Singapore (+65)',
                                                                            '421' => 'Slovak Republic (+421)',
                                                                            '386' => 'Slovenia (+386)',
                                                                            '677' => 'Solomon Islands (+677)',
                                                                            '252' => 'Somalia (+252)',
                                                                            '27' => 'South Africa (+27)',
                                                                            '34' => 'Spain (+34)',
                                                                            '94' => 'Sri Lanka (+94)',
                                                                            '290' => 'St. Helena (+290)',
                                                                            '1869' => 'St. Kitts (+1869)',
                                                                            '1758' => 'St. Lucia (+1758)',
                                                                            '249' => 'Sudan (+249)',
                                                                            '597' => 'Suriname (+597)',
                                                                            '268' => 'Swaziland (+268)',
                                                                            '46' => 'Sweden (+46)',
                                                                            '41' => 'Switzerland (+41)',
                                                                            '963' => 'Syria (+963)',
                                                                            '886' => 'Taiwan (+886)',
                                                                            '7' => 'Tajikstan (+7)',
                                                                            '66' => 'Thailand (+66)',
                                                                            '228' => 'Togo (+228)',
                                                                            '676' => 'Tonga (+676)',
                                                                            '1868' => 'Trinidad & Tobago (+1868)',
                                                                            '216' => 'Tunisia (+216)',
                                                                            '90' => 'Turkey (+90)',
                                                                            '7' => 'Turkmenistan (+7)',
                                                                            '993' => 'Turkmenistan (+993)',
                                                                            '1649' => 'Turks & Caicos Islands (+1649)',
                                                                            '688' => 'Tuvalu (+688)',
                                                                            '256' => 'Uganda (+256)',
                                                                            '380' => 'Ukraine (+380)',
                                                                            '971' => 'United Arab Emirates (+971)',
                                                                            '598' => 'Uruguay (+598)',
                                                                            '7' => 'Uzbekistan (+7)',
                                                                            '678' => 'Vanuatu (+678)',
                                                                            '379' => 'Vatican City (+379)',
                                                                            '58' => 'Venezuela (+58)',
                                                                            '84' => 'Vietnam (+84)',
                                                                            '84' => 'Virgin Islands - British (+1284)',
                                                                            '84' => 'Virgin Islands - US (+1340)',
                                                                            '681' => 'Wallis & Futuna (+681)',
                                                                            '969' => 'Yemen (North)(+969)',
                                                                            '967' => 'Yemen (South)(+967)',
                                                                            '260' => 'Zambia (+260)',
                                                                            '263' => 'Zimbabwe (+263)',
                                                                    ];
                                                                ?>
                                                                    <select class="form-control js-example-basic-single" id="tbl_users_contrycode" name="tbl_users_contrycode">
                                                                       <option value="">Select</option>
                                                                        <?php 
                                                                        foreach ($array as $key => $value) 
                                                                        {?>
                                                                            <option value="<?php echo $key;?>"><?php echo "+".$key;?></option>
                                                                        <?php 
                                                                        }
                                                                        ?>
                                                                    </select> 
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="tbl_users_mobile" class="form-control" id="tbl_users_mobile"  maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter your Mobile Number" />
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <div class="row">
                                                                <div class="col-md-9 ">
                                                                    <label for="firstName1">Photo</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" name="tbl_users_photo" class="custom-file-input" id="tbl_users_photo">
                                                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label for="firstName1">Gender</label>
                                                            <!-- <div class="custom-file"> -->
                                                                <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="M"> <span>Male</span></label>
                                                                <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="F"> <span>Female</span></label>
                                                                <label class="rdiobox"><input name="tbl_users_gender" type="radio" value="O"> <span>Other</span></label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 table-responsive"> 
                                                             <h4>Personal Details</h4> 
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">Occupation</label>
                                                            <input type="text" name="tbl_personal_details_occupation" class="form-control" id="tbl_personal_details_occupation" placeholder="Occupation" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="firstName1">Date of Birth</label>
                                                            <input type="date" name="tbl_personal_details_dob" class="form-control" id="tbl_personal_details_dob" />
                                                           
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="phone">Optopnal Phone No.</label>
                                                            <input type="text" name="tbl_personal_details_optional_telephone" class="form-control" id="tbl_personal_details_optional_telephone" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter Optopnal Phone Number" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                                <?php $social =('facebook,instagram,twitter,hordings,addvertisements,website')?>
                                                                <select name="tbl_personal_details_howdidyouknow" class="form-control" id="tbl_personal_details_howdidyouknow">
                                                                    <?php
                                                                    foreach ($variable as $key => $value) {?>
                                                                        <option value="<?php echo $value;?>"><?php echo $value;?></option>
                                                                   <?php }?>
                                                                </select>
                                                            </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">Eduction</label>
                                                            <input type="text" name="tbl_personal_details_education" class="form-control" id="tbl_personal_details_education" placeholder="Education" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="firstName1">Eduction Doc.</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="tbl_personal_details_educational_doc" class="custom-file-input" id="tbl_personal_details_educational_doc">
                                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose
                                                                            file</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">District</label>
                                                            <input type="text" name="tbl_personal_details_district" class="form-control" id="tbl_personal_details_district" placeholder="First Name" />
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Town/Village</label>
                                                            <input type="text" name="tbl_personal_details_town_village" class="form-control" id="tbl_personal_details_town_village" placeholder="Town/Village" />
                                                        </div>
                                                        <div class="col-md-4 form-group mb-3">
                                                            <label for="lastName1">Post Code</label>
                                                            <input type="text" name="tbl_personal_details_postcode" class="form-control" id="tbl_personal_details_postcode" placeholder="Post Code" />
                                                        </div>
                                                        <div class="col-md-12 table-responsive"> 
                                                             <h4>Business Details</h4> 
                                                        </div>  
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">Business Name</label>
                                                            <input type="text" name="tbl_business_details_name" class="form-control" id="tbl_business_details_name" placeholder="Business Name" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="firstName1">Insustry</label>
                                                            <input type="text" name="tbl_business_details_industry" class="form-control" id="Insustry" />
                                                           
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="exampleInputEmail1">Business Email</label>
                                                            <input type="email" name="tbl_business_details_email" class="form-control" id="tbl_business_details_email"  placeholder="Enter your Email Address" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="phone">Business Phone No.</label>
                                                            <input type="text" name="tbl_business_details_phone" class="form-control" id="tbl_business_details_phone" maxlength="13" minlength="8" pattern="[0-9]{8,13}" title="Phone Number length should be between 8-13" placeholder="Enter Optopnal Phone Number" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">Business District</label>
                                                            <input type="text" name="tbl_business_details_district" class="form-control" id="tbl_business_details_district" placeholder="Business District" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">Business Town/Village</label>
                                                            <input type="text" name="tbl_business_details_town_village" class="form-control" id="tbl_business_details_town_village" placeholder="Business Town/Village" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="firstName1">Business Doc.</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="tbl_business_details_business_doc" class="custom-file-input" id="tbl_business_details_business_doc">
                                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose
                                                                            file</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">No Of Employees</label>
                                                            <input type="Number" name="tbl_business_details_employees" class="form-control" id="tbl_business_details_employees" placeholder="No Of Employees" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="lastName1">Investment Need</label>
                                                            <input type="text" name="tbl_business_details_investmant_need" class="form-control" id="tbl_business_details_investmant_need" placeholder="Investment Need" />
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                                <label for="firstName1">Are You a Team?</label>
                                                            <!-- <div class="custom-file"> -->
                                                                <label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="1"> <span>Yes</span></label><label class="rdiobox"><input name="tbl_business_details_areyouteam" type="radio" value="0"> <span>No</span></label>
                                                        </div>  

                                                    </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-12 team">
                                            <div class="row ">
                                                 <section class="container col-xs-12">
                                                    <div class="table table-responsive">
                                                    <h4>Select Team Details</h4>
                                                    <table id="ppsale" class="table table-responsive table-striped table-bordered">
                                                      <thead>
                                                        <tr>
                                                            <td>First Name</td>
                                                            <td>Last Name</td>
                                                            <td>Email</td>
                                                            <td>Mobile NO.</td>
                                                            <td>Remove</td>
                                                          </tr>
                                                      </thead>
                                                      <tbody id="TextBoxContainer">
                                                       <td>
                                                          <input name="tbl_smme_teams_first_name[]" class="sku form-control form-control-lg" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name">
                                                        </td>
                                                        <td>
                                                          <input  name="tbl_smme_teams_last_name[]" class="price form-control form-control-lg" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name">
                                                        </td>
                                                        <td>
                                                          <input name="tbl_smme_teams_email[]" class="gst form-control form-control-lg" id="tbl_smme_teams_email"  type="email" placeholder="Enter Emailid">
                                                        </td>
                                                        <td>
                                                          <input name="tbl_smme_teams_mobile[]" class="qty form-control form-control-lg" id="tbl_smme_teams_mobile"  type="tel" maxlength="10" placeholder="Enter Mobile No.">
                                                        </td>                                           
                                                        <td>
                                                            &nbsp;
                                                        </td>
                                                        </tr>
                                                      </tbody>
                                                      <tfoot>
                                                        <tr>
                                                          <th colspan="6">
                                                          <button id="btnAdd" type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Add more" style="float: right;">+</button></th>
                                                        </tr>
                                                      </tfoot>
                                                    </table>
                                                    </div>
                                                  </section>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                                    <button class="btn btn-primary sub">Submit</button>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
        </div>
        <?= $footer; ?>
        <script type="text/javascript">
            $('document').ready(function(){
                $(".team").hide();
                $("input[name='tbl_business_details_areyouteam']").click(function(){
                    var radioValue = $(this).val();
                    if(radioValue == 1){

                        $(".team").show();
                        
                    }
                    else
                    {
                        $(".team").hide();
                    }
                });
                 $('#username').on('keyup', function(){
                  var username = $('#username').val();
                  $.ajax({
                    url: '<?=base_url()?>admin/company/Company/check_username',
                    type: 'post',
                    data: {
                        'username' : username,
                        'id':0,
                    },
                    success: function(response){
                        //alert(response);
                        console.log(response);
                        var obj = jQuery.parseJSON(response);
                        var subcat_data = obj;
                      if (subcat_data == 'taken') {
                        //alert("fghdjhd");
                        
                        $('#username').siblings("span").text('Sorry... Username already taken Use Other Username').css("color", "red");
                        $('#sub').attr("disabled", true);
                      }else if (subcat_data == "not_taken") {
                       // alert("sdfre");
                       
                        $('#username').siblings("span").text('Username available').css("color", "green");
                        $('#sub').attr("disabled", false);
                      }/*
                      else
                      {
                        alert("syuerureyt");
                      }*/
                    }
                  });
                 });        
                $('#email').on('keyup', function(){
                    var email = $('#email').val();
                    $.ajax({
                      url: "<?=base_url()?>admin/user/User/check_email",
                      type: 'post',
                      data: {
                        'email' : email,
                        'id':0,
                      },
                      success: function(response){
                        //alert(response);
                         var obj = jQuery.parseJSON(response);
                        var subcat_data = obj;
                        if (subcat_data == 'taken' ) {
                          $('#email').siblings("span").text('Sorry... Email id already taken Use Other Email id').css("color", "red");
                          $('#sub').attr("disabled", true);
                        }else if (subcat_data == 'not_taken') {
                          $('#email').siblings("span").text('Email id available').css("color", "green");
                          $('#sub').attr("disabled", false);
                        }
                      }
                    });
                });
            });
        </script>
        <script type="text/javascript">
                        $(document).ready(function() {
                         
                            $("#btnAdd").bind("click", function () {
                                var div = $("<tr />");
                                div.html(GetDynamicTextBox(""));
                                $("#TextBoxContainer").append(div);
                                
                            });
                            $("body").on("click", ".remove", function () {
                    
                                $(this).closest("tr").remove();
                              
                            });
                          });
                          function GetDynamicTextBox(value) 
                          {
                              return '<td><input name="tbl_smme_teams_first_name[]" class="sku form-control form-control-lg" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name"></td><td><input  name="tbl_smme_teams_last_name[]" class="price form-control form-control-lg" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name"></td><td><input name="tbl_smme_teams_email[]" class="gst form-control form-control-lg" id="tbl_smme_teams_email"  type="text" placeholder="Enter Emailid"></td><td><input name="tbl_smme_teams_mobile[]" class="qty form-control form-control-lg" id="tbl_smme_teams_mobile"  type="text" placeholder="Enter Mobile No."></td><td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove"><i class="typcn-delete-outline"></i></button></td>';
                          }
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                //get state
                $("#tbl_user_zone").change(function() {
                    var zone_id = $(this).val();
                   
                    jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>admin/user/User/get_state_by_zone",
                        dataType: 'text',
                        data: {zone_id:zone_id},
                        success: function(data) 
                        { //alert(data);
                            //console.log(data);
                            var obj = jQuery.parseJSON(data);
                            var subcat_data = obj;
                            //console.log(subcat_data);
                            var html = '<option value="">Select</option>';
                            $.each(subcat_data,function(index,data){
                                //alert(data.tbl_subcategory_id);
                                html += '<option value="'+data.tbl_state_id+'">'+data.tbl_state_name+'</option>';
                              });
                            $('#tbl_user_state').html(html);
                        }
                    });
                return false;
                });
                //get city
                $("#tbl_user_state").change(function() {
                    var state_id = $(this).val();
                    
                    jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>admin/user/User/get_city_by_state",
                        dataType: 'text',
                        data: {state_id:state_id},
                        success: function(data) 
                        { //alert(data);
                            //console.log(data);
                            var obj = jQuery.parseJSON(data);
                            var subcat_data = obj;
                            //console.log(subcat_data);
                            var html = '<option value="">Select</option>';
                            $.each(subcat_data,function(index,data){
                                //alert(data.tbl_subcategory_id);
                                html += '<option value="'+data.tbl_city_id+'">'+data.tbl_city_name+'</option>';
                              });
                            $('#tbl_user_city').html(html);
                        }
                    });
                return false;
                });
                $("#tbl_user_city").change(function() {
                    var city_id = $(this).val();
                    
                    jQuery.ajax({
                        type: "POST",
                        url: "<?=base_url()?>admin/company/Company/get_zip_by_city",
                        dataType: 'text',
                        data: {city_id:city_id},
                        success: function(data) 
                        { //alert(data);
                            //console.log(data);
                            var obj = jQuery.parseJSON(data);
                            var subcat_data = obj;
                            //console.log(subcat_data);
                            var html = '<option value="">Select</option>';
                            $.each(subcat_data,function(index,data){
                                //alert(data.tbl_subcategory_id);
                                html += '<option value="'+data.tbl_zip_id+'">'+data.tbl_zip_code+'</option>';
                              });
                            $('#tbl_user_zip').html(html);
                        }
                    });
                return false;
                });
                $("#generatepass").click(function(){

                    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
                    var pass = "";
                    for (var x = 0; x < 11; x++) {
                        var i = Math.floor(Math.random() * chars.length);
                        pass += chars.charAt(i);
                    }
                   
                    $('#password').val(pass);
                    
                 });
            });
        </script>
    </body>
</html>