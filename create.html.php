<?php
  /**
   * @var \Pimcore\Templating\PhpEngine $this
   * @var \Pimcore\Templating\PhpEngine $view
   * @var \Pimcore\Templating\GlobalVariables $app
   */

  $this->extend('Layout/home.html.php');
  $SMlat = $this->get('session')->get('SMlat');
  $SMlon = $this->get('session')->get('SMlon');
  // $ccEmailaddress = array();
?>
<div class="breadcrumb">
  <ul>
    <li><a href="#">Create Demand List</a></li>
  </ul>
</div>
<div class="row m-0 px-2 py-5">
  <!-- Content start-->
  <div class="col-12">
    <div class="row mb-5">
      <div class="col-12">
        <div class="card">
            <div class="card-header card-header-orange d-flex align-items-center">
              <i class="far fa-user-circle fa-3x align-self-center mr-3"></i>
              <h6 class="m-0">Create Demand List</h6>
            </div>
            <div class="card-body">
              <form class="cmxform" id="commentForm" method="post">
                <div class="row">
                  <div class="col-lg-6">
                    <h6>Enter your details information</h6>
                    <input type="text" id="LastName" name="LastName" class="form-control form-control-df mb-3 " placeholder="Full Name" disabled value="<?=$this->get('session')->get('profile')['name']; ?>" />

                    <div class="select-df mb-3">
                      <select disabled id="Pid" name="Pid" class="form-control form-control-md">
                        <option value="" disabled selected>Primary ID Type</option>
                        <option>New NRIC</option>
                        <option>Old NRIC</option>
                        <option>Police</option>
                        <option>Military</option>
                        <option selected="">Business Registration Number</option>
                        <option>Company without BRN</option>
                        <option>MyPR</option>
                        <option>MyKAS</option>
                        <option>Passport</option>
                      </select>
                    </div>

                    <input type="text" id="CustomerIDNo" name="CustomerIDNo" disabled class="form-control form-control-df mb-3" placeholder="BRN NO" value="<?=$this->get('session')->get('profile')['group_business_reg_no']; ?>"/>

                    <input type="text" id="Emailaddress" name="Emailaddress" disabled class="form-control form-control-df mb-3" placeholder="Email Address"  value="<?=$this->get('session')->get('profile')['email']; ?> "/>

                    <!-- Additional Email Address Section -->
                    <div class="row">
                      <div class="col-10">
                        <input type="text" id="ccEmail_1" name="ccEmail_1" class="form-control form-control-df mb-3" placeholder="Additional Email Address #1" value=""/>
                      <div id="new_chq"></div>
                        <input type="hidden" value="1" id="total_chq" name="">
                      </div>
                      <div class="col-2">
                        <button type="button" class="add btn btn-orange-white" style="padding: 14px 13px; font-size: 10px;">
                          <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="remove btn btn-orange-white" style="padding: 14px 13px; font-size: 10px;">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- Additional Email Address Section -->

                    <div class="select-df mb-3">
                      <select id="PackageType" name="PackageType" class="form-control form-control-md">
                        <option value="Residential"selected>Residential</option>
                        <option  value="BIZ">BIZ</option>
                      </select>
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <div class="select-df">
                          <select disabled  id="contactPrefix" name="contactPrefix"  class="form-control form-control-md">
                            <option value="" disabled selected><?=$this->get('session')->get('profile')['contact_m_prefix']; ?></option>
                            <option>011</option>
                            <option >012</option>
                            <option >013</option>
                            <option >014</option>
                            <option >015</option>
                            <option >016</option>
                            <option >017</option>
                            <option >018</option>
                            <option>019</option>
                          </select>
                        </div>
                      </div>

                      <input type="text" id="AlternatePhone" name="AlternatePhone" disabled class="form-control form-control-df w-50" maxlength="10" placeholder="AlternatePhone" value="<?=$this->get('session')->get('profile')['contact_m']; ?>"> 
                    </div>

                    <?php if($this->ReasonOfUnavailability == 'Port Full') { ?>
                      <?php if(!empty($SMlat) && !empty($SMlon)){ ?>  
                        <div class="row">
                            <div class="col-6">
                                <input type="text" id="latitude" name="" class="form-control form-control-df mb-3" disabled placeholder="Latitude" value="<?php echo $SMlat; ?>" maxlength="20" required />
                                <input type="hidden" name="latitude" value="<?php echo $SMlat; ?>">
                            </div>
                            <div class="col-6">
                                <input type="text" id="longitude" name="" class="form-control form-control-df mb-3 " disabled placeholder="Longitude" value="<?php echo $SMlon; ?>" maxlength="20" required/>
                                <input type="hidden" name="longitude" value="<?php echo $SMlon; ?>">
                            </div>
                        </div>
                      <?php } else { ?>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" id="latitude" name="latitude" class="form-control form-control-df mb-3 " placeholder="Latitude" value="" maxlength="20" />
                            </div>
                            <div class="col-6">
                                <input type="text" id="longitude" name="longitude" class="form-control form-control-df mb-3 " placeholder="Latitude" value="" maxlength="20" />
                            </div>
                        </div>
                      <?php } ?>
                  <?php } else { ?>
                      <div class="row">
                        <div class="col-6">
                          <input type="text" id="latitude" name="latitude" class="form-control form-control-df mb-3 " placeholder="Latitude" value="" maxlength="20" />
                          <?php if ($this->ReasonOfUnavailability != 'Port Full') { ?>
                          <font id="latitude-asterisk" style="color:red;display:block;visibility:visible;position:absolute;top:15px;left:90px">* </font>
                          <?php } ?>
                        </div>
                        <div class="col-6">
                          <input type="text" id="longitude" name="longitude" class="form-control form-control-df mb-3 " placeholder="Longitude" value="" maxlength="20" />
                          <?php if ($this->ReasonOfUnavailability != 'Port Full') { ?>
                          <font id="longitude-asterisk" style="color:red;display:block;visibility:visible;position:absolute;top:15px;left:105px">* </font>
                          <?php } ?>
                        </div>
                      </div>
                  <?php } ?>
                    <input type="text" class="form-control form-control-df mb-3 " placeholder="Reason Of Unavailability" disabled value="<?=$this->ReasonOfUnavailability?>" />
                    <input type="hidden" name="reasonOfUnavailability" id="reasonOfUnavailability" value="<?=$this->ReasonOfUnavailability?>" />

                    <input type="text" id="returnOrderNo" name="returnOrderNo" class="form-control form-control-df mb-3" placeholder="Returned Order Number" value="" maxlength="20" />

                    <p>Please attach utility or assessment bill for further verification.</p>
                    <p>(max size 1MB per file)</p>
                    <label for="file-upload" id="dragAndDropnew" name="dragAndDropnew" class="custom-file-upload btn btn-grey-white">
                      Add Attachment
                    </label>
                    <input id="demandbuttonUpload" type="file" style="display:none;" />
                    <div class="col-12" id="attachmentHtml">
                      <div class="media-body">
                        <br />
                        <h6>File Name:</h6>
                        <p id="fileName"></p>
                      </div>
                    </div>
                    <input type="hidden" name="haveUpload" id="haveUpload" value="" />
                  </div>
                   
                  <div class="col-lg-6">
                    <h6>Enter your address information</h6>

                    <?php
                    $isDisabled = '';
                    if ($this->ReasonOfUnavailability == 'Port Full') {
                      $isDisabled = 'disabled';
                    }
                    ?>

                    <input type="text" id="UnitNumber" name="UnitNumber" class="form-control form-control-df mb-3" placeholder="Unit Number" <?= $isDisabled; ?> value="<?=$this->data['UnitNumber']?>" onkeydown="upperCaseF(this)" maxlength="50" />

                    <input type="text" id="FloorNumber" name="FloorNumber" class="form-control form-control-df mb-3" placeholder="Floor Number" <?= $isDisabled; ?> value="<?=$this->data['FloorNumber']?>" onkeydown="upperCaseF(this)" maxlength="50" />

                    <input type="text" id="BuildingName" name="BuildingName" class="form-control form-control-df mb-3" placeholder="Building Name" <?= $isDisabled; ?> value="<?=$this->data['BuildingName']?>" onkeydown="upperCaseF(this)"   maxlength="100"/>

                    <div class="select-df mb-3">
                      <select name="StreetType" id="StreetType" name="StreetType" class="form-control form-control-md mb-3" placeholder="Street Type" value="">
                        <option value="" disabled selected > Street Type </option>
                        <option value="ALUR" >ALUR</option>
                        <option value="AVENUE" >AVENUE</option>
                        <option value="BATU" >BATU</option>
                        <option value="BULATAN" >BULATAN</option>
                        <option value="CABANG" >CABANG</option>
                        <option value="CERUMAN" >CERUMAN</option>
                        <option value="CERUNAN" >CERUNAN</option>
                        <option value="CHANGKAT" >CHANGKAT</option>
                        <option value="CROSS" >CROSS</option>
                        <option value="DALAMAN" >DALAMAN</option>
                        <option value="DATARAN" >DATARAN</option>
                        <option value="DRIVE" >DRIVE</option>
                        <option value="GAT" >GAT</option>
                        <option value="GELUGOR" >GELUGOR</option>
                        <option value="GERBANG" >GERBANG</option>
                        <option value="GROVE" >GROVE</option>
                        <option value="HALA" >HALA</option>
                        <option value="HALAMAN" >HALAMAN</option>
                        <option value="HALUAN" >HALUAN</option>
                        <option value="HILIR" >HILIR</option>
                        <option value="HUJUNG" >HUJUNG</option>
                        <option value="JALAN" >JALAN</option>
                        <option value="JAMBATAN" >JAMBATAN</option>
                        <option value="JETTY" >JETTY</option>
                        <option value="KAMPUNG" >KAMPUNG</option>
                        <option value="KELOK" >KELOK</option>
                        <option value="LALUAN" >LALUAN</option>
                        <option value="LAMAN" >LAMAN</option>
                        <option value="LANE" >LANE</option>
                        <option value="LANGGAK" >LANGGAK</option>
                        <option value="LEBOH" >LEBOH</option>
                        <option value="LEBUH" >LEBUH</option>
                        <option value="LEBUHRAYA" >LEBUHRAYA</option>
                        <option value="LEMBAH" >LEMBAH</option>
                        <option value="LENGKOK" >LENGKOK</option>
                        <option value="LENGKONGAN" >LENGKONGAN</option>
                        <option value="LIKU" >LIKU</option>
                        <option value="LILITAN" >LILITAN</option>
                        <option value="LINGKARAN" >LINGKARAN</option>
                        <option value="LINGKONGAN" >LINGKONGAN</option>
                        <option value="LINGKUNGAN" >LINGKUNGAN</option>
                        <option value="LINTANG" >LINTANG</option>
                        <option value="LINTASAN" >LINTASAN</option>
                        <option value="LORONG" >LORONG</option>
                        <option value="LOSONG" >LOSONG</option>
                        <option value="LURAH" >LURAH</option>
                        <option value="M G" >M G</option>
                        <option value="MAIN STREET" >MAIN STREET</option>
                        <option value="MEDAN" >MEDAN</option>
                        <option value="OFF JALAN" >OFF JALAN</option>
                        <option value="P.O.Box" >P.O.Box</option>
                        <option value="PARIT" >PARIT</option>
                        <option value="PEKELILING" >PEKELILING</option>
                        <option value="PERMATANG" >PERMATANG</option>
                        <option value="PERSIARAN" >PERSIARAN</option>
                        <option value="PERSINT" >PERSINT</option>
                        <option value="PERSISIRAN" >PERSISIRAN</option>
                        <option value="PESARA" >PESARA</option>
                        <option value="PESIARAN" >PESIARAN</option>
                        <option value="PIASAU" >PIASAU</option>
                        <option value="PINGGIAN" >PINGGIAN</option>
                        <option value="PINGGIR" >PINGGIR</option>
                        <option value="PINGGIRAN" >PINGGIRAN</option>
                        <option value="PINTAS" >PINTAS</option>
                        <option value="PINTASAN" >PINTASAN</option>
                        <option value="PO Box" >PO Box</option>
                        <option value="PUNCAK" >PUNCAK</option>
                        <option value="REGAT" >REGAT</option>
                        <option value="ROAD" >ROAD</option>
                        <option value="SEBERANG" >SEBERANG</option>
                        <option value="SELASAR" >SELASAR</option>
                        <option value="SELEKOH" >SELEKOH</option>
                        <option value="SILANG" >SILANG</option>
                        <option value="SIMPANG" >SIMPANG</option>
                        <option value="SIMPANGAN" >SIMPANGAN</option>
                        <option value="SISIRAN" >SISIRAN</option>
                        <option value="SLOPE" >SLOPE</option>
                        <option value="SOLOK" >SOLOK</option>
                        <option value="STREET" >STREET</option>
                        <option value="SUSUR" >SUSUR</option>
                        <option value="SUSURAN" >SUSURAN</option>
                        <option value="TAMAN" >TAMAN</option>
                        <option value="TANJUNG" >TANJUNG</option>
                        <option value="TEPIAN" >TEPIAN</option>
                        <option value="TINGGIAN" >TINGGIAN</option>
                        <option value="TINGKAT" >TINGKAT</option>
                        </select>
                    </div>
                    <input  type="text" id="StreetAddress2" name="StreetAddress2" class="form-control form-control-df mb-3" placeholder="Street Name" <?= $isDisabled; ?> value="<?=$this->data['StreetName']?>" onkeydown="upperCaseF(this)" maxlength="50"/>

                    <input type="text" id="PostalCode" name="PostalCode" class="form-control form-control-df mb-3" placeholder="Postal Code" <?= $isDisabled; ?> value="<?=$this->data['PostalCode']?>" onkeydown="upperCaseF(this)" maxlength="12"/>
                    
                    <input type="text" id="Section" name="Section" class="form-control form-control-df mb-3" placeholder="Section" <?= $isDisabled; ?> value="<?=$this->data['Section']?>" onkeydown="upperCaseF(this)"  maxlength="50"/>

                    <input type="text" id="City" name="City" class="form-control form-control-df mb-3" placeholder="City" <?= $isDisabled; ?> value="<?=$this->data['City']?>" onkeydown="upperCaseF(this)" maxlength="50"/>
                  
                    <div class="select-df mb-3">
                      <select id="State" name="State" class="form-control form-control-md mb-3">
                        <option value="" disabled selected> State </option>
                        <option>MELAKA</option>
                        <option>KELANTAN</option>
                        <option>KEDAH</option>
                        <option>JOHOR</option>
                        <option>NEGERI SEMBILAN</option>
                        <option>PAHANG</option>
                        <option>PERAK</option>
                        <option>PERLIS</option>
                        <option>PULAU PINANG</option>
                        <option>SABAH</option>
                        <option>SARAWAK</option>
                        <option>SELANGOR</option>
                        <option>TERENGGANU</option>
                        <option>WILAYAH PERSEKUTUAN</option>
                        <option>WILAYAH PERSEKUTUAN LABUAN</option>
                        <option>WILAYAH PERSEKUTUAN PUTRAJAYA</option>
                      </select>
                    </div>
                     <input id="submitDemandForm" class="btn btn-grey-white w-350px submit float-right" type="submit" value="Submit">
                     <input type="hidden" name="exchange" id="exchange" value="<?=$this->data['Exchange']?>" />
                     <input type="hidden" name="neid" id="neid" value="<?=$this->data['NEID']?>" />
                  </div>  
                </div>        
              </form>
            </div>
        </div>
      </div>
    </div>
 
  </div>
  <!-- Content end-->

  <!-- Modals -->
  <div class="modal fade" id="modalUploadStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title" id="submitTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-orange-dark text-white"></div>
        <div class="modal-header text-center">
          <h6 class="modal-title" id="submitResult"></h6>
        </div>
      </div>
    </div>
  </div>
  <!-- Modals end-->
</div>

<!-- Include modal -->
<?=$this->template("Layout/popupmodal.html.php");?>
<?=$this->template("Layout/popupError.html.php");?>

<?php
$this->headScript()->appendFile("/newpublic/js/jquery.validate.js");
$this->headScript()->appendFile("/newpublic/js/dropzone.js");
$this->headScript()->appendFile("/newpublic/js/demand.js");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
  $('.add').on('click', add);
  $('.remove').on('click', remove);
  function add(){
     // name='AdditionalEmailAddress"+new_chq_no+"' 
      var new_chq_no = parseInt($('#total_chq').val())+1;
      var view_no = new_chq_no+1;
      // var new_input="<input type='text' id='ccEmail ' name='ccEmail' class='ccEmailAddress_"+new_chq_no+" form-control form-control-df mb-3' placeholder='Additional Email Address #"+new_chq_no+"' value=''>";
      var new_input="<input type='text' id='ccEmail_"+new_chq_no+"' name='ccEmail_"+new_chq_no+"' class='form-control form-control-df mb-3' placeholder='Additional Email Address #"+new_chq_no+"' value=''>";
      // var new_input="<input type='text' id='ccEmailAddress_"+new_chq_no+"'name='ccEmailAddress['"+new_chq_no+"']' class='form-control form-control-df mb-3' placeholder='Additional Email Address #"+view_no+"' value=''>";
      if(new_chq_no <= 5){
        $('#new_chq').append(new_input);
        $('#total_chq').val(new_chq_no);
      }
      console.log(new_chq_no);   
    }
    function remove(){
      var last_chq_no = $('#total_chq').val();
      if(last_chq_no>1){
        $('#ccEmail_'+last_chq_no).remove();
        $('#total_chq').val(last_chq_no-1);
      }
    }
</script>
                    <div class="row">
                      <div class="col-10">
                        <input type="text" id="ccEmail_1" name="ccEmail_1" class="form-control form-control-df mb-3" placeholder="Additional Email Address #1" value=""/>
                      <div id="new_chq"></div>
                        <input type="hidden" value="1" id="total_chq" name="">
                      </div>
                      <div class="col-2">
                        <button type="button" class="add btn btn-orange-white" style="padding: 14px 13px; font-size: 10px;">
                          <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="remove btn btn-orange-white" style="padding: 14px 13px; font-size: 10px;">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#latitude").keyup(function(){
      if($(this).val() != '') {
        $('#latitude-asterisk').css({
          "display" : "none",
          "visibility":"hidden"
        });
      } else {
        $('#latitude-asterisk').css({
          "display" : "block",
          "visibility":"visible"
        });
      }
    });

    $("#longitude").keyup(function(){
      if($(this).val() != '') {
        $('#longitude-asterisk').css({
          "display" : "none",
          "visibility":"hidden"
        });
      } else {
        $('#longitude-asterisk').css({
          "display" : "block",
          "visibility":"visible"
        });
      }
    });

    var populatedStreetType = "<?php echo $this->data['StreetType']; ?>";
    $('#StreetType').val(populatedStreetType).change();
    if (populatedStreetType!='') {
      $("#StreetType").prop("disabled", true);
    }
    var populatedState = "<?php echo $this->data['State']; ?>";
    $('#State').val(populatedState).change();
    if (populatedState!='') {
      $("#State").prop("disabled", true);
    }

    $.validator.addMethod("lettersOnly", function (value, element) {
      var nricValue = $("#Pid").val();
      if(nricValue == 'New NRIC' || nricValue == 'Old NRIC'){
        return this.optional(element) || /^[0-9-]+$/i.test(value);
      }
      else{
        return true;
      }
        
    }, "Please enter valid NRIC.");
     
    $.validator.setDefaults({
      submitHandler: function() { 
        console.log('demand submission...');     
        $('#confirmSubmitDemand').modal('toggle');
      }
    });

    $("#commentForm").validate({
      ignore: "",
      rules: {
        LastName: {
          required: true,
        },
        CustomerIDNo: {
          required: true,
          lettersOnly: true
        },
         AlternatePhone: {
          required: true,
          number: true,
          minlength: 10
        },
         latitude: {
          required: function () {
            return $("#reasonOfUnavailability").val()!='Port Full';
          },
          maxlength: 20
        },
         longitude: {
          required: function () {
            return $("#reasonOfUnavailability").val()!='Port Full';
          },
          maxlength: 20
        },
         haveUpload: {
          required: function () {
            return $("#reasonOfUnavailability").val()!='Port Full';
          }
        },
         UnitNumber: {
          required: true,
          maxlength: 50
        },
         FloorNumber: {
          maxlength: 50
        },
         BuildingName: {
          maxlength: 100
        },
        StreetAddress2: {
          required: true,
          maxlength: 50
        },
        PostalCode: {
          required: true,
          number: true,
          minlength: 5,
          maxlength: 5
        },
         Section: {
          maxlength: 50
        },
         City: {
          required: true,
          maxlength: 50
        },
        Pid:{ required: true},
        StreetType:{ required: true},
        State:{ required: true},
        Emailaddress: {
          required: true,
          email: true
        }, 
      },      
      messages: {
        LastName: {
          required: "Please enter Full Name"
        },
          CustomerIDNo: {
          required: "Please enter Customer ID No"
        },
         AlternatePhone: {
          required: "Please enter valid phone number"
        },
         latitude: {
          required: "Please enter Latitude"
        },
         longitude: {
          required: "Please enter Longitude"
        },
         haveUpload: {
          required: "Please upload File"
        },
         UnitNumber: {
          required: "Please enter Unit Number"
        },
        StreetType: {
          required: "Please enter Street Type"
        },
        StreetAddress2: {
          required: "Please enter Street Name"
        },
        PostalCode: {
          required: "Please enter Postal Code"
        },
         City: {
          required: "Please enter City"
        },
        Pid: {
          required: "Please enter ID Type"
        },
         State: {
          required: "Please enter State"
        },
        Emailaddress: "Please enter valid email address"
      }  
    });

    $('#haveUpload').on('change', function(){
      $(this).valid();
    })
  });

  function upperCaseF(a){
    setTimeout(function(){
      a.value = a.value.toUpperCase();
    }, 1);
  }
</script>