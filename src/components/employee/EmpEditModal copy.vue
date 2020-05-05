<template>
  <!-- Start Edit Modal ********************************************* -->

  <div class="modal fade" id="empeditmodal" role="dialog">
    <div class="modal-dialog" style="width:900px">
      <!-- Modal content-->
      <div class="modal-content" style="background-color:#f4f4f4">
        <div class="modal-header"
          style="background-color: #eaeaea; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 58px; ">
          <button @click="modalclosed" type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">Edit Employee</h4> -->
          <h3 class="modal-title" style="font-weight:bolder" v-if="addmode">Add Employee</h3>
          <h3 class="modal-title" style="font-weight:bolder" v-else>Edit Employee</h3>
        </div>

        <!-- form in place of modal body div -->
        <!-- <form method="post" class="modal-body" enctype="multipart/form-data" v-on:submit.prevent="updateItem"> -->

        <form id="empform" class="form-horizontal" enctype="multipart/form-data" method="POST" files="true"
          v-on:submit.prevent="addupdateitem" style="padding:0px;">



          <!-- VALIDATION ERROR: on top of form. validation error(422 (Unprocessable Entity)) -->
          <!-- other errors including network errors are shown with tostr in catch block-->
          <div id="emptoperrbar" class="toperrbar">
            <ul>
              <li v-for="item in formErrors">{{ item[0]}}</li>
            </ul>
          </div>




          <div class="modal-body" style="padding-left:40px; padding-bottom:10px; padding-top:20px;padding-bottom:20px;">
            <!-- <div class="row col-xs-8" style="width:820px;padding: 0px; border-bottom: 1px solid lightgrey;margin-bottom: 5px;">     
          Main row-->
            <!-- <div
            class="row col-xs-8"
            style="width:600px;padding: 0px;margin-bottom:5px;border-bottom: 0px solid #cccccc;"
            method="post"
            action="/employee/updateItem"
            v-on:submit.prevent="addupdateitem()"
          > -->









            <!-- start row -->
            <div class="row">




              <!-- start left col -->
              <div class="col-sm-5">


                <div class="form-group" hidden>
                  <label for="EmpID">EmpID</label>
                  <input type="text" class="form-control" name="EmpID" id="EmpID" v-model="formdata.EmpID" />
                </div>
                <!-- margin-right:0px;text-align:left;font-size: 13px;letter-spacing: -.3px;padding-left:0px; color:black; -->
                <div class="form-group">
                  <label class="control-label col-sm-4">EmployeeID</label>
                  <!-- v-model="formdata.EmployeeID" to bind to data  -->
                  <div class="col-sm-5">

                    <input type="text" class="form-control" name="EmployeeID" 
                      v-model="formdata.EmployeeID" />

                    <!-- <dd id="ddFirstname">{{formdata.EmployeeID}}</dd> -->

                    <div style="width:250px;" v-if="formErrors['EmployeeID']" class="error text-danger">
                      {{ formErrors['EmployeeID'][0]}}
                    </div>
                    <!-- <li  v-if="formErrors['EmployeeID']"  
                class="error text-danger" 
                style="width:300px;"  
                v-for="item in formErrors['EmployeeID']">{{ item}}</li> -->
                  </div>
                </div>




                <div class="form-group">
                  <label class="control-label col-sm-4">Full name</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="FullName" id="FullName" v-model="formdata.FullName" />
                  </div>
                </div>






                <div class="form-group">
                  <label class="control-label col-sm-4">Prefix</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="Prefix" v-model="formdata.Prefix">
                      <option v-for="item in lstPrefix" :value="item.ListID">{{ item.Str1 }}</option>
                    </select>
                  </div>
                </div>


                <!-- For swowing multiple errors for a field loop is used-->
                <!-- to show a single error >{{formErrors['Firstname'][0]}}<" could be used instead of loop -->
                <!-- in controller 'Firstname' => 'bail|email|max:2', "bail" could be used just to process and send the first error-->
                <div class="form-group">
                  <label class="control-label col-sm-4">First name</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" v-model="formdata.Firstname" />
                    <div style="width:250px;" v-if="formErrors['Firstname']" class="error text-danger">
                      {{ formErrors['Firstname'][0]}}
                    </div>
                    <!-- <li
                  v-if="formErrors['Firstname']"
                  class="error text-danger"
                  style="width:300px;"
                  v-for="item in formErrors['Firstname']">{{ item}}</li> -->



                  </div>
                </div>


                <!-- {{ formErrors['Firstname'][0]}} -->


                <div class="form-group">
                  <label class="control-label col-sm-4">Last name</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="Lastname" v-model="formdata.Lastname" />
                    <div style="width:250px;" v-if="formErrors['Lastname']" class="error text-danger">
                      {{ formErrors['Lastname'][0]}}
                    </div>
                    <!-- <li
                  v-if="formErrors['Lastname']"
                  class="error text-danger"
                  style="width:300px;"
                  v-for="item in formErrors['Lastname']">{{ item}}</li> -->
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-sm-4">Middle I</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="MiddleI" v-model="formdata.MiddleI" />

                    <div style="width:250px;" v-if="formErrors['MiddleI']" class="error text-danger">
                      {{ formErrors['MiddleI'][0]}}
                    </div>

                    <!-- <li
                  v-if="formErrors['MiddleI']"
                  class="error text-danger"
                  style="width:300px;"
                  v-for="item in formErrors['MiddleI']">{{ item}}</li>-->

                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-sm-4">Suffix</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="Suffix" v-model="formdata.Suffix">
                      <option v-for="item in lstSuffix" :value="item.ListID">{{ item.Str1 }}</option>
                    </select>
                  </div>
                </div>

                <!-- note NOW using v-model because date is send from the controller in format(using carbon 'Y-m-d') recognised
            Note no form v-model binding is used since having problem with html5 date -->
                <!-- by html date input which is yyyy-MM-dd  -->
                <div class="form-group">
                  <label class="control-label col-sm-4">Hire date</label>
                  <div class="col-sm-5">
                    <input style="min-width:250px;" type="date" name="HireDate" 
                      class="form-control startdate" placeholder="mm/dd/yyyy" v-model="formdata.HireDate" />

                    <div style="width:250px;" v-if="formErrors['HireDate']" class="error text-danger">
                      {{ formErrors['HireDate'][0]}}
                    </div>

                  </div>
                </div>




                <!--<div class="checkbox">
                        <label>
                          <input type="checkbox"> Check me out
                        </label>
            </div>-->



                <div class="form-group">
                  <label class="control-label col-sm-4">Department</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="Department" 
                      v-model="formdata.Department">
                      <option v-for="item in lstDepartment" :value="item.ListID">{{ item.Str1 }}</option>
                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-sm-4">Job title</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="JobTitle" 
                      v-model="formdata.JobTitle">
                      <option v-for="item in lstJobTitle" :value="item.ListID">{{ item.Str1 }}</option>
                    </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-sm-4">Registration</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="Registration" 
                      v-model="formdata.Registration">
                      <option v-for="item in lstRegistration" :value="item.ListID">{{ item.Str1 }}</option>
                    </select>
                  </div>
                </div>

              </div>
              <!-- End left col -->



              <div class="col-sm-6" style="padding-left:70px;">
                <!-- start right col -->

                <div class="form-group">
                  <label class="control-label col-sm-5">DisciplineSF330</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="DisciplineSF330" 
                      v-model="formdata.DisciplineSF330">
                      <option v-for="item in lstDisciplineSF330" :value="item.ListID">{{ item.Str2 }}</option>
                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-sm-5">DisciplineSF254</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="DisciplineSF254"
                      v-model="formdata.DisciplineSF254">
                      <option v-for="item in lstDisciplineSF254" :value="item.ListID">{{ item.Str1 }}</option>
                    </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-sm-5">Company name</label>
                  <div class="col-sm-5">
                    <!-- use  v-model="formdata.ComID" in select to make selected from data -->
                    <select type="select" class="form-control" name="ComID" v-model="formdata.ComID">
                      <option v-for="item in lstComID" :value="item.ComID">{{ item.CompanyName }}</option>
                    </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-sm-5">Exp.with other firm</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="ExpWithOtherFirm"
                      v-model="formdata.ExpWithOtherFirm" />
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-sm-5">Employee status</label>
                  <div class="col-sm-5">
                    <select type="select" class="form-control" name="EmployeeStatus"
                      v-model="formdata.EmployeeStatus">
                      <option v-for="item in lstEmployeeStatus" :value="item.ListID">{{ item.Str1 }}</option>
                    </select>
                  </div>
                </div>


                <!-- <div class="checkbox"> -->
                <!-- ***use " :true-value="1" to sho checked as per form value"> -->
                <!-- https://stackoverflow.com/questions/43982779/vue-js-set-checkboxes-checked-if-statement-is-true -->




                <div class="form-group">
                  <label class="control-label col-sm-5">Employee_Consultant</label>
                  <div class="col-sm-5">
                    <!-- note: ":true-value="1" should be used to tellchkbox for which value it should be checked -->
                    <input :true-value="1" :false-value="0" type="checkbox" name="Employee_Consultant" 
                       v-model="formdata.Employee_Consultant" style="margin-top:10px;" />
                  </div>
                </div>


                <!-- <div class="row">
                <div class="form-group col-xs-12 col-sm-6"   v-if="!image" style="margin-top: 0px">
                  <label for="ImageData" style="margin-bottom: 5px">Select an image</label>
                  <input type="file" @change="onFileChange" style="padding-left:0; height: 20" name="ImageData"  id="ImageData">
                </div>
        
                <div  v-else class="form-group col-xs-12 col-sm-6" id="Photo" style="background-color: white; width: 150px; height: 150px; margin-left: 16px; padding-left: 0" ><img :src="image" alt="no image selected" style="height:130px; border: 1px solid  lightgrey;">
                <button @click="removeImage" style="margin-top: 5px;margin-bottom: 30px">Remove image</button>
                </div>
            </div> -->

                <div class="form-group">
                  <label class="control-label col-sm-5">Select an image</label>

                  <div class="col-sm-5">
                    <!-- <img id="imageid" :src="'images/empphoto/'+ formdata.ImageData" alt="" style="width:50px;"> -->
                    <img id="imageid" :src="dynamicimagepath" alt=""
                      style="width:100px; border:1px solid #ddd; margin-top:10px;margin-bottom:10px;">

                    <!-- image size validation -->
                    <div style="width:300px;" v-if="formErrors['Image']" class="error text-danger">
                      {{ formErrors['Image'][0]}}
                    </div>

                    <!-- <input type="file" style="padding-left:0; height: 20" name="ImageData"  id="ImageData" v-on:change="onFileChange">   -->
                    <!-- <input type="file" style="padding-left:0; height: 20" name="ImageData"  id="ImageData" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> -->
                    <input type="file" accept="image/*" style="display:none; padding-left:0; height: 20;"
                      ref="fileInput" name="Image" id="ImageData" v-on:change="onFileChange">





                    <!--  customising input btn https://www.youtube.com/watch?v=VqnJwh6E9ak -->
                    <div class="row">
                      <div class="col-sm-6">
                        <button class="btn btn-default btn-sm" @click.prevent="$refs.fileInput.click()">Choose
                          File</button>
                      </div>
                      <div class="col-sm-6">
                        <button class="btn btn-default btn-sm" style="margin-left:12px;"
                          @click.prevent="removeImage">Remove Image</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- End right col -->

            </div>
            <!-- End Main row -->

          </div>
          <!-- End Modal body -->

          <!-- <a id="test">test</a> -->

          <div class="modal-footer" style="padding-bottom:20px;background-color:#f4f4f4;border-top: 1px solid #c9c9c9;">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" style="margin-left: 7px; " id="save"> -->
            <button type="submit" class="btn btn-primary" id="save" style="width:100px">Save</button>
            <button type="button" @click="modalclosed"
              style="width:100px;background-color:#e6e6e6;border-color:#c5c5c5;w" class="btn btn-secondary"
              data-dismiss="modal">Cancel</button>
          </div>

          <!-- this is used for clicking outside of modal which cannot be catched by modal buttons close event. so fired by jquery -->
          <!-- <h1 id="emphiddenmodalonhide" @click="modalonhide()" hidden>hiddenmodalonhide</h1>          -->


        </form>
        <!-- form in place of modal body div -->
      </div>
      <!-- content -->
    </div>
    <!-- end div modal dialog -->
  </div>
  <!-- End Edit Modal ********************************************************-->
</template>

<script>
  import axios from "axios";
  import moment from "moment";

  export default {
    name: "empeditmodal",
    data() {
      return {
        count: 0,

        lstPrefix: [],
        lstSuffix: [],
        lstJobTitle: [],
        lstDepartment: [],
        lstRegistration: [],
        lstDisciplineSF330: [],
        lstDisciplineSF254: [],
        lstEmployeeStatus: [],
        lstComID: [],

        image: {}, //'/images/employee/AlthaverDB.jpg',
        //dynamic image path. Needed because img src is binded with formdata and has a path. 
        //so when user pick another image he cannot immidiately see the image since it it not stored in the path yet
        //to solve this dynamicimagepath is used
        dynamicimagepath: '',

        offset: 4,
        formErrors: {},
        formErrorsUpdate: {},

        //GENERAL ERROR: Test if any error other than validation error(422 (Unprocessable Entity))
        // errstatus:false, // not using now since using jquery for slide  instead of v-if
        errstatusttext: '',

        formdata: {

          EmployeeID: '',
          Prefix: 0,
          Firstname: '',
          Lastname: '',
          MiddleI: '',
          Suffix: 0,
          JobTitle: 0,
          Department: 0,
          Registration: 0,
          DisciplineSF330: 0,
          DisciplineSF254: 0,
          HireDate: '',
          ComID: 0,
          EmployeeStatus: 0,
          Employee_Consultant: 0,
          ExpWithOtherFirm: '', // 0.00 used '' to avoid showing 0 in add
          FullName: '',
          ImageData: '',
          Image: {}, // extra field not in db for saving photofile in folder
          EmpID: 0,
          // created_at:'',
          // updated_at:'' // only passing created_at at add, updated_at is taken care by Mysql
        },

        addmode: true, // to switch between updateitem and additem

      };
    },
    // props: ["empid"],


    methods: {


      // this is for clicking outside of modal which cannot be catched by modal buttons close event
      modalonhide() {
        this.formErrors = "";
        //  $("#emptoperrbar").hide();  
        $("#emptoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
        this.addmode = true;
        $("#HireDate").val(''); // have to clear date with JQuery instead of slearing formdata since it is not binded


      },

      modalclosed() {
        this.formErrors = "";

        this.image = '';
        this.formdata.Image = '';
        this.formdata.ImageData = '';
        // this.imagefilename='';
        this.dynamicimagepath = ''; // must clear the dynamicimagepath too
        $("#ImageData").val(''); // to remove file name from file input

        // this.errstatus=false;
        // this.errstatusttext='';

        // to get a slidedown effect of errorbar with jquery
        // $("#emptoperrbar").hide();
        $("#emptoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
      },


      // image related **********************************
      // https://codepen.io/Atinux/pen/qOvawK/
      onFileChange(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createImage(files[0]);

        var fileData = event.target.files[0];
        this.image = fileData;
        this.formdata.Image = event.target.files[0]; // save the image to formdata

      },

      createImage(file) {
        var image = new Image();
        var reader = new FileReader();
        // var vm = this;

        reader.onload = (e) => {
          // vm.image = e.target.result;
          this.image = e.target.result;
          this.dynamicimagepath = e.target.result;
        };
        reader.readAsDataURL(file);
      },

      removeImage: function (e) {
        this.image = '';
        this.formdata.Image = ''; // Added for addmode
        // this.imagefilename='';
        this.formdata.ImageData = '';
        this.dynamicimagepath = "";
        $("#ImageData").val(''); // to remove file name from file input
      },

      // END image related *******************************************************



      clearaddform() {
        // ** Should clear formdata since it could be populated with previous edit data
        this.formdata.EmployeeID = '';
        this.formdata.Prefix = 0;
        this.formdata.Firstname = '';
        this.formdata.Lastname = '';
        this.formdata.MiddleI = '';
        this.formdata.Suffix = 0;
        this.formdata.JobTitle = 0;
        this.formdata.Department = 0;
        this.formdata.Registration = 0;
        this.formdata.DisciplineSF330 = 0;
        this.formdata.DisciplineSF254 = 0;
        this.formdata.HireDate = '';
        this.formdata.ComID = 0;
        this.formdata.EmployeeStatus = 0;
        this.formdata.Employee_Consultant = 0;
        this.formdata.ExpWithOtherFirm = '';  // 0.00 used '' to avoid showing 0 in add
        this.formdata.FullName = '',
        this.formdata.ImageData = '';
        this.formdata.EmpID = 0;
        // this.formdata.created_at='';
        // this.formdata.updated_at=''; // only passing created_at at add, updated_at is taken care by Mysql

        this.image = '';
        this.formdata.Image = ''; // extra field not in db for saving photofile in folder
        this.formdata.ImageData = '';
        // this.imagefilename='';
        this.dynamicimagepath = ''; // must clear the dynamicimagepath too        
        // this.imagefilename='';
        $("#ImageData").val(''); // to remove file name from file input


        this.formErrors = "";
        this.errstatus = false;
        this.errstatusttext = '';
        // to get a slidedown effect of errorbar with jquery
        // $("#emptoperrbar").hide();
        $("#emptoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition

        this.addmode = true; // must set to true here for extra safety(since modal can hide by clicking outside of modal)

      },



      loadeditdata(id) {

        // this.image = '';
        // this.imagefilename='';
        $("#ImageData").val(''); // to remove file name from file input
        this.dynamicimagepath = ''; // must clear the dynamicimagepath too


        this.addmode = false
        //to get edit data from databese instead of table row
        // axios
        axios // used to store common Aothorization header value of api_token
          // .get("apiempeditdata/" + id + "").then(response => {
          .get(this.$host + "api/employee/" + id + "").then(response => {
            this.formdata = response.data;


            //Change date format using moment.js 
            // let hiredate = moment(response.data.HireDate).format("YYYY-MM-DD");
            // this.formdata.HireDate = hiredate;

           //Change date format using moment.js to make html datepicker work
           if (!response.data.HireDate=="") {
            let hiredate = moment(response.data.HireDate).format("YYYY-MM-DD");
            this.formdata.HireDate = hiredate;
            } else { // for null date
            let hiredate2 = moment('0000-00-00').format("yyyy-MM-dd");
            this.formdata.HireDate = hiredate2;
            }
if (response.data.HireDate=='1900-01-01') {
  this.formdata.HireDate='';
}




            // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'Y-m-d')
            // to use html5 date we have to convert date format since it cannot read
            // (html date has masking which jquery datepicker dont have which is essential for preventing wrong data with server error
            // so moment is used to convert date to YYYY-MM-DD which html date can read 
            //http://jsfiddle.net/r42jg/303/
            // so that it is recognised by html datepicker which is yyyy-MM-dd
            // if (this.formdata.HireDate!==null) {
            //   let userDate = this.formdata.HireDate;//'1999-02-13 00:00:00';
            //   var date_string = moment(userDate, "YYYY.MM.DD").format("YYYY-MM-DD");
            // $("#HireDate").val(date_string);
            // }


            //NOT REQUIRED if nullable is used in validation and database******************************************** */
            // // to show '' (instead of 01/01/1900) in html datepicker box when data is default date of '1900-01-01 00:00:00'
            // // since html5 datepicker always put '1900-01-01 00:00:00' instead of null
            // if (this.formdata.HireDate=='1900-01-01 00:00:00') {
            //     $("#HireDate").val('');
            // }
            //********************************************************************************************************** */


            // load the image from the path and this.formdata.ImageData 
            this.dynamicimagepath = "images/empphoto/" + this.formdata.ImageData;

          })
          .catch(err => {
            console.log(err);
          });

      },



      // using same method and modal form for add and edit
      addupdateitem() {

        // Check user type. Blocked temporarily for testing
        // **************************************************
        // var s1 = this.$usertype;
        // var s2 = "admin";
        // if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
        //   // alert("You don't have permission to run this operation");
        //   $("#globalunauthorisedmsg").modal("show");
        //   //  $("#empeditmodal").modal("hide");
        //   return;
        // }

        let apiurl = ''

        if (this.addmode) {
          // apiurl = "apiempadddata/";
          apiurl = this.$host+"api/employee/add";
        } else {
          // apiurl = "apiempupdatedata/";
          apiurl = this.$host+"api/employee/update";
          // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'Y-m-d')
          // so that it is recognised by html datepicker which is yyyy-MM-dd
          // and thus we can use model binding for date
          // this.formdata.HireDate=$("#HireDate").val();
        }

        // this.formdata.ImageData="/images/"+this.formdata.ImageData;
        // this.formdata.ImageData=this.image;
        // this.formdata.ImageData= document.getElementById("ImageData").files[0];



        //NOT REQUIRED if nullable is used in validation and database******************************************** */

        // // have to use " 00:00:00" with date else will not update
        // var str=$("#HireDate").val()+" 00:00:00"
        // this.formdata.HireDate=str;//"2019-08-04 13:17:29";


        // //added for Mysql database
        // if ($("#HireDate").val()==='') {
        //   this.formdata.HireDate="1900-01-01 00:00:00";//"2019-08-04 13:17:29";
        // }
        //******************************************************************************************************* */


        // **IMPORTANT: files cannot be uloaded Without using FormData(js class)
        // var form = $("#empform").get(0); // get the form to pass into formData constructor 
        var fd = new FormData();

        fd.append("EmpID", this.formdata.EmpID);
        fd.append("EmployeeID", this.formdata.EmployeeID);
        fd.append("Firstname", this.formdata.Firstname);
        fd.append("Lastname", this.formdata.Lastname);
        fd.append("Prefix", this.formdata.Prefix);
        fd.append("FullName", this.formdata.FullName);


        // FormData sends null date in "this.formdata.HireDate" as null string and validation fails
        // so only send date if date is not NULL in database, Not sending anything will put NULL in database
        if (this.formdata.HireDate !== null) {
          fd.append("HireDate", this.formdata.HireDate);
        }


        // // only passing created_at generated during add, and not changing it after that
        // // then in everu update passin the same value for created_at
        // // If we dont pass created_at, it gets blank during update, updated_at is taken care by Mysql as timestamp date
        // fd.append("created_at", this.formdata.created_at);
        // // fd.append("updated_at", this.formdata.updated_at);


        // **********************************************************************
        //** */  Note:Employee update data is send through FormData to upload image file. But FormData sends string "null" for NULL values 
        // of database. So the string fields updates with the string 'null' instead of real NULL.
        // So in vue file check for NULL and replace with '' for string fields. Or use JQuery toget the field value

        // Form data sends null middleI as string "null". so validation for max 1 character fails. So use Jquery val which is empty
        fd.append("MiddleI", $("#MiddleI").val());


        //  Foreign key is used in main table for List items col which has to set to null(instead of 0) 
        //  ONDELETE(when a list item row id deleted) as per mysql. 
        //  But null cannot be inserted in int field so 0 is set here
        //  In Employee FormData is used instead of this.formdata for Image. But FormData sends null as string 'null'
        //  So for Employee where FormData is used null value has to be converted to '' before sending to controller
        //  Sending a value of '' will store NULL in the field if default value for the field is NULL

        if (this.formdata.JobTitle == null) { this.formdata.JobTitle = ''; }
        if (this.formdata.Suffix == null) { this.formdata.Suffix = ''; }
        if (this.formdata.Department == null) { this.formdata.Department = ''; }
        if (this.formdata.Registration == null) { this.formdata.Registration = ''; }
        if (this.formdata.ComID == null) { this.formdata.ComID = ''; }
        if (this.formdata.DisciplineSF330 == null) { this.formdata.DisciplineSF330 = ''; }
        if (this.formdata.DisciplineSF254 == null) { this.formdata.DisciplineSF254 = ''; }
        if (this.formdata.EmployeeStatus == null) { this.formdata.EmployeeStatus = ''; }


        // **********************************************************************


        fd.append("ExpWithOtherFirm", this.formdata.ExpWithOtherFirm);
        fd.append("Suffix", this.formdata.Suffix);
        fd.append("JobTitle", this.formdata.JobTitle);
        fd.append("Department", this.formdata.Department);
        fd.append("Registration", this.formdata.Registration);
        fd.append("ComID", this.formdata.ComID);
        fd.append("DisciplineSF330", this.formdata.DisciplineSF330);
        fd.append("DisciplineSF254", this.formdata.DisciplineSF254);
        fd.append("EmployeeStatus", this.formdata.EmployeeStatus);
        fd.append("Employee_Consultant", this.formdata.Employee_Consultant);
        //  fd.append("ImageData", this.formdata.ImageData);

        // var imagename = $("#EmployeeID").val() + ".jpg";
        // var fileInput = this.formdata.Image;//document.getElementById("ImageData").files[0];
        // var fileInput = this.formdata.Image;

        //  // if condition is used to avoid error if no file is choosen
        //     if (fileInput!=null) {
        //       // formData.append('Image', fileInput, imagename);
        //       formData.append('Image', fileInput);
        //     }



        // // if ($("#ImageData").val()!="") {
        // if (this.formdata.Image !== "null") {
        //   // formData.append('Image', fileInput, imagename);
        //   fd.append('Image', fileInput);
        // }

        // NOW USING AXIOS    
        this.$axios.post(apiurl, this.formdata).then(response => {
          // axios.post(apiurl, formData).then((response) => { // if response data is needed before catch

          $("#empeditmodal").modal("hide");

          // alert("success")
          // toastr.success("Item Updated Successfully.", "Success Alert", {
          //   timeOut: 3000
          // });



          if (this.addmode==true) {
              let eid=response.data
              this.$router.push({
                name: "empdetail", // name property of this route must be used in route list to use with parameter
                params: { empid: eid },
                query:  { this:eid}  // query param is used to pass empid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
              });
          } else {
            $('#employeeTable').DataTable().ajax.reload(); // refresh parent table
          }

          let msg=""
          if (this.addmode==true) {
            msg="Added Employee successfully"
          } else {
            msg="Employee has been edited successfully"
          }
          iziToast.success({
            title: "Successful",
            position:"topRight",
            message: msg
          });



          this.addmode = true; //now done in onmodalhide(), still used here     



          // this.formErrors=""; now done in onmodalhide() // clear form error else will appear on the form


          // // now done in onmodalhide() 
          // if (this.formErrors === "") {
          //       this.addmode=true; // set to default true, For edit it is set to false in loadeditdata() method
          //       console.log("Updated from addmode: "+ this.addmode);
          // }                      

        })
          .catch((err) => {

            console.log(err)

            //axios Network Error doesnt have err.response.status, so used seperate condition
            if (err.message === "Network Error") {
              // this.errstatus=true; // not using now since using jquery for slide instead of v-if
              // this.errstatusttext=err.message;
              // $('#emptoperrbar').slideDown();

              $("#empeditmodal").modal("hide");
              toastr.error("Could not Save. " + err.message, "Alert", {
                timeOut: 5000 //3000
              });
              return;
            }


            // ** have to write following validation err code below Network Error since network err has no err.response.status
            //    So checking the following code before network err which uses status will give error
            //    So also "return" is used. If nework err it will not execute following code
            if (err.response.status === 422) {
              this.formErrors = err.response.data; // validation error(422 (Unprocessable Entity))
              // to get a slidedown effect of errorbar with jquery since only with v-if it is not possible
              // jquery slide jumps if a initial height is not given. If height set to auto it still jumps
              // but we dont know the height. so find number of items to set initial height
              var totalerr = Object.keys(this.formErrors).length //count the number of properties(errors) in a JavaScript object
              var height = 30 + (totalerr * 20);
              // $("#emptoperrbar").css("height", height+'px');
              // $('#emptoperrbar').slideDown();

              // Now using css transition instead of jquery to slide uo and down added in master.blade
              // $("#emptoperrbar").css("transition", 'height 300ms'); // css transition instead of jquery to slide uo and down
              $("#emptoperrbar").css("height", height + 'px');
              // $('#emptoperrbar').show();
              return;
            }

            // GENERAL ERROR: Test  if any error other than validation error(422 (Unprocessable Entity) or Network Error)
            // Note following code should execude only if above 2 are not true. So "return" is used on top 2 if conditions
            // this.errstatus=true;  // not using now since using jquery for slide  instead of v-if
            // this.errstatusttext=err.response.statusText + " : " + err.message;
            // this.errstatusttext=err.response.status +" : "+err.response.statusText;

            // to get a slidedown effect of errorbar with jquery since only with v-if it is not possible
            // $('#emptoperrbar').slideDown();

            $("#empeditmodal").modal("hide");
            toastr.error("Could not Save. " + err.response.statusText + " : " + err.message, "Alert", {
              timeOut: 5000 //3000
            });

          });  // end catch

      },


      // now using same method and modal form for add and edit
      updateItem() {


        // // this.$http.post("/api/apiempupdatedata/", this.formData).then(
        //   this.$http.post("/api/apiempupdatedata/", this.formdata).then(
        //   response => {
        //     // $('#blah').prop('src', '');

        //     $("#empeditmodal").modal("hide");
        //     // document.getElementById("ImageData").text = '/images/employee/'+ imagename;
        //     // $('#blah').prop('src', '/images/employee/'+ imagename);

        //     // $('#editModal').on('hidden', function(){
        //     //   $('#editModal').trigger( "reset" );
        //     // });

        //     // toastr.success("Item Updated Successfully.", "Success Alert", {
        //     //   timeOut: 3000
        //     // });

        //   console.log("Updated");
        //   this.formErrors=""; // clear form error else will appear on the form
        //   $('#employeeTable').DataTable().ajax.reload(); // refresh parent table

        //   },
        //   response => {
        //     this.formErrors = response.data;
        //   }
        // );


      }





    },

    mounted() {

      // call vue data inside jquery,no need for hidden element click for indirect call
      // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component

      var self = this;


      // if clicked outside of bootstrap modal it hides and cannot catch this event with vue
      // so indiretcly catching this event by vue event "modalonhide" which will fire with a hidden btn click
      // called from this jquery modal hide function  
      $('#empeditmodal').on('hidden.bs.modal', function () {
        //  $('#emphiddenmodalonhide').click();
        self.modalonhide();
      });


      // to get a slidedown effect of errorbar with jquery
      // $("#emptoperrbar").hide();

      setTimeout(() => {
        // set time is used to load combo after parent table is loaded to make table load fast
        // this.$http
        //   .get("/api/apilstJobTitle")
        //   .then(function(response) {
        //     this.lstJobTitle = response.body;
        //   });

        // axios.get("/api/apilstJobTitle")
        //         .then((response) => {
        //             this.lstJobTitle = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });

        // // axios is used to store common header with api_token value
        // axios.get("/api/apilstJobTitle",{
        //     headers: {
        //             'Authorization': this.$apitoken
        //              }
        //         }).then((response) => {
        //             this.lstJobTitle = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });  


        // NOW GLOBAL baseURL and Authorization Header is used
        //       axios.get("apilstJobTitle").then((response) => {
        //             this.lstJobTitle = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //             console.log("going");
        //         });  

        // axios.get("apilstDepartment",).then((response) => {
        //             this.lstDepartment = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });
        // axios.get("apilstPrefix").then((response) => {
        //             this.lstPrefix = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });
        // axios.get("apilstSuffix").then((response) => {
        //             this.lstSuffix = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });
        // axios.get("apilstRegistration").then((response) => {
        //             this.lstRegistration = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });
        // axios.get("apilstDisciplineSF330").then((response) => {
        //             this.lstDisciplineSF330 = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });
        // axios.get("apilstDisciplineSF254").then((response) => {
        //             this.lstDisciplineSF254 = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });
        // axios.get("apilstEmployeeStatus").then((response) => {
        //             this.lstEmployeeStatus = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });
        // axios.get("apilstComID").then((response) => {
        //             this.lstComID = response.data
        //         }).catch((err) => {
        //             console.log(err)
        //         });



        // now receiving all combo in one request under a group
        // ***********************************************************************

        // axios.get("apiempcombogroup").then((response) => {
        //       this.lstJobTitle = response.data.List_EmpJobTitle;
        //       this.lstDepartment = response.data.List_Department;
        //       this.lstPrefix = response.data.List_EmpPrefix;
        //       this.lstSuffix = response.data.List_EmpSuffix;
        //       this.lstRegistration = response.data.List_EmpRegistration;
        //       this.lstDisciplineSF330 = response.data.List_DisciplineSF330;
        //       this.lstDisciplineSF254 = response.data.List_DisciplineSF254;
        //       this.lstEmployeeStatus = response.data.List_EmpStatus;
        //       this.lstComID = response.data.Com_Main;

        //   }).catch((err) => {
        //       console.log(err)
        //       console.log("going");
        //   });  


        axios.get(self.$host + "api/empcombo/emp").then((response) => {

          this.lstJobTitle = response.data[0].jobtitle;
          this.lstDepartment = response.data[1].department;
          this.lstPrefix = response.data[2].prefix;
          this.lstSuffix = response.data[3].suffix;
          this.lstRegistration = response.data[4].registration;
          this.lstDisciplineSF330 = response.data[5].disciplinesf330;
          this.lstDisciplineSF254 = response.data[6].disciplinesf254;
          this.lstEmployeeStatus = response.data[7].employeestatus;
          this.lstComID = response.data[8].comid;


          // console.log(response.data[1].department);

        }).catch((err) => {
          console.log(err)
        });



      }, 1000); // 2000); This promise will be resolved in 2000 milli-seconds




      // // call vue data inside jquery
      // // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component
      // var self = this;
      // $("#test").click(function(){
      //   alert(self.formdata.EmployeeID);
      // });



    } // mounted


  };
</script>

<style>
  /* search combo styles************************************ */
  #empform .form-group {
    margin-bottom: 5px;
  }


  #empform select[type="select"] {
    height: 30px;
    width: 250px;
    border-radius: 2px;
  }

  #empform input[type="date"] {
    height: 30px;
    width: 250px;
    border-radius: 2px;
  }

  #empform input[type="text"] {
    /* height: 30px; */
    height: 27px;
    width: 250px;
    border-radius: 2px;
  }

  /*align labels left*/
  .form-horizontal .control-label {
    text-align: left;
    margin-bottom: 0px;
    font-size: 13px;
    color: black;
    font-family: "Helvetica", Arial, sans-serif;
    padding-top: 5px;

    /* style="margin-right:0px;padding-left:30px;text-align:left;font-size: 13px; color:black;" */
  }

  /* END search combo styles************************************ */
</style>