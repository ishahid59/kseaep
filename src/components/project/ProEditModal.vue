<template>
  <!-- Start Edit Modal ********************************************* -->




  <div class="modal fade" id="proeditmodal" role="dialog">
    <div class="modal-dialog" style="width:720px">
      <!-- Modal content-->
      <div class="modal-content" >
        <div
          class="modal-header"
          style="background-color: #f1f1f1; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 52px; "
        >
          <button @click="modalclosed"  type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title">Edit Project</h4> -->
            <h4 class="modal-title" v-if="addmode">Add Project</h4>
            <h4 class="modal-title" v-else>Edit Project</h4>
        </div>

        <!-- form in place of modal body div -->
        <!-- <form method="post" class="modal-body" enctype="multipart/form-data" v-on:submit.prevent="updateItem"> -->

        <form
          id="proform"
          class="form-horizontal"
          enctype="multipart/form-data"
          v-on:submit.prevent="addupdateitem"
          style="padding:0px;"
        >


        <!-- VALIDATION ERROR: on top of form. validation error(422 (Unprocessable Entity)) -->
        <div 
            id="protoperrbar"
            class="toperrbar"
            >
            <ul><li v-for="item in formErrors">{{ item[0]}}</li></ul>
        </div>


         <div class="modal-body" style="padding-left:50px; padding-bottom:10px; padding-top:20px;padding-bottom:20px;">

          <!-- <div
            class="row col-xs-8"
            style="width:600px;padding: 0px;margin-bottom:5px;border-bottom: 0px solid #cccccc;"
            method="post"
            action="/employee/updateItem"
            v-on:submit.prevent="addupdateitem()"
          > -->
            <div class="form-group" hidden >
              <label for="ProjectID">ProjectID</label>
              <input type="text" class="form-control" name="ProjectID" id="ProjectID" v-model="formdata.ProjectID" />
            </div>


            <!-- <div class="form-group" v-if="!IE"> -->
              <div class="form-group" >
              <label class="control-label col-sm-3">Project no.</label>
              <div class="col-sm-5">
                <input 
                  type="text"
                  class="form-control"
                  name="ProjectNo"
                  id="ProjectNo"
                  v-model="formdata.ProjectNo"
                />
                <!-- <li
                  v-if="formErrors['ProjectNo']"
                  class="error text-danger"
                  style="width:300px;"
                  v-for="item in formErrors['ProjectNo']">{{ item}}</li> -->
                <div style="width:440px; "
                  v-if="formErrors['ProjectNo']"
                  class="error text-danger"
                 >{{ formErrors['ProjectNo'][0]}}
                </div>

              </div>
            </div>




            <div class="form-group">
              <label class="control-label col-sm-3">Project name</label>
              <div class="col-sm-5">
                <input
                  type="text"
                  class="form-control"
                  name="ProjectName"
                  id="ProjectName"
                  v-model="formdata.ProjectName"
                />
                <!-- <li
                  v-if="formErrors['ProjectNo']"
                  class="error text-danger"
                  style="width:300px;"
                  v-for="item in formErrors['ProjectNo']">{{ item}}</li> -->
                <div style="width:440px; "
                  v-if="formErrors['ProjectName']"
                  class="error text-danger"
                 >{{ formErrors['ProjectName'][0]}}
                </div>

              </div>
            </div>






   <!-- :disabled="formdata.ProjectRole==4" -->
            <div class="form-group" >
              <label class="control-label col-sm-3">Project role</label>
              <div class="col-sm-5">
                <!-- @change="changedtoIE" used. If IE is selected after entering data in the following disabled fields it has to be cleared -->
                <select
             :disabled="formdata.ProjectRole==4 && addmode==false"
                  @change="changedtoIE"
                  type="select"
                  class="form-control"
                  name="ProjectRole"
                  id="ProjectRole"
                  v-model="formdata.ProjectRole"
                >
                  <option v-for="item in lstProPRole" :value="item.ListID">{{ item.Str1 }}</option>
                </select>                
                <!-- <li
                  v-if="formErrors['ProjectRole']"
                  class="error text-danger"
                  style="width:300px;"
                  v-for="item in formErrors['ProjectRole']">{{ item}}</li> -->
                <div style="width:440px; "
                  v-if="formErrors['ProjectRole']"
                  class="error text-danger"
                 >{{ formErrors['ProjectRole'][0]}}
                </div>

              </div>
            </div>


            <!-- For swowing multiple errors for a field loop is used-->
             <!-- to show a single error >{{formErrors['Firstname'][0]}}<" could be used instead of loop -->
             <!-- in controller 'Firstname' => 'bail|email|max:2', "bail" could be used just to process and send the first error-->
            <div class="form-group" >
              <label class="control-label col-sm-3" >Award year</label>
              <div class="col-sm-5">
                <input
                  type="text"
                  class="form-control"
                  id="AwardYear"
                  v-model="formdata.AwardYear"
                />
                <div style="width:440px; "
                  v-if="formErrors['AwardYear']"
                  class="error text-danger"
                 >{{ formErrors['AwardYear'][0]}}
                </div>
              </div>
            </div>


            
<!-- {{ formErrors['Firstname'][0]}} -->




            <div class="form-group" >
              <label  class="control-label col-sm-3">Owner category</label>
              <div class="col-sm-5">
                <select
                  type="select"
                  class="form-control"
                  name="OwnerCategory"
                  id="OwnerCategory"
                  v-model="formdata.OwnerCategory"
                >
                  <option v-for="item in lstProOCategory" :value="item.ListID">{{ item.Str1 }}</option>
                </select>
              </div>
            </div>



           <div class="form-group" >
              <label  class="control-label col-sm-3">Owner</label>
              <div class="col-sm-5">
                <select
                  type="select"
                  class="form-control"
                  name="Owner"
                  id="Owner"
                  v-model="formdata.Owner"
                >
                  <option v-for="item in lstCAOID" :value="item.CAOID">{{ item.Name }}</option>
                </select>
              </div>
            </div>


           <div class="form-group" >
              <label  class="control-label col-sm-3">Client</label>
              <div class="col-sm-5">
                <select
                  type="select"
                  class="form-control"
                  name="Client"
                  id="Client"
                  v-model="formdata.Client"
                >
                  <option v-for="item in lstCAOID" :value="item.CAOID">{{ item.Name }}</option>
                </select>
              </div>
            </div>




            <div class="form-group" >
              <label  class="control-label col-sm-3">Primary project type</label>
              <div class="col-sm-5">
                <select
                  type="select"
                  class="form-control"
                  name="PrimaryProjectType"
                  id="PrimaryProjectType"
                  v-model="formdata.PrimaryProjectType"
                >
                  <option v-for="item in lstProjectType" :value="item.ListID">{{ item.Str1 }}</option>
                </select> 

                <div style="width:440px; "
                  v-if="formErrors['PrimaryProjectType']"
                  class="error text-danger"
                 >{{ formErrors['PrimaryProjectType'][0]}}
                </div>


              </div>
            </div>



            <!-- <div class="form-group">
              <label class="control-label col-sm-3">Secondary Project Type</label>
              <div class="col-sm-5">
                <input
                  type="text"
                  class="form-control"
                  name="SecondaryProjectType"
                  id="SecondaryProjectType"
                  v-model="formdata.SecondaryProjectType"
                />
              </div>
            </div> -->


            <!-- Bootstrap Multi select https://www.youtube.com/watch?v=sy7NQHcDsLk -->
            <!-- https://www.webslesson.info/2017/05/bootstrap-multi-select-dropdown-with-checkboxes-using-jquery-in-php.html -->
            <div class="form-group" >
              <label  class="control-label col-sm-3">Secondary project type</label>
              <div class="col-sm-5 multiproeditsecproject">
                  <!-- note: binding is not used since it needs array to check items -->
                  <select id="multiproeditsecproject"  multiple class="form-control" >
                      <!-- filling items from combo fill api since options wont work here. v-model is not used. instead check items in method loadeditdata  -->
                      <!-- <option v-for="item in lstProOCategory">{{ item.Str1 }}</option> -->
                      <!-- <option v-for="item in lstProjectType" :value="item.ListID">{{ item.Str1 }}</option> -->

                  </select>
              </div>
            </div>


        


          <!-- <a @click="test" >test</a> -->


            <!-- <div class="form-group">
              <label class="control-label col-sm-3">Secondary Project Type</label>
              <div class="col-sm-5">
                <input
                  type="text"
                  class="form-control"
                  name="SecondaryProjectType"
                  id="SecondaryProjectType"
                  v-model="formdata.SecondaryProjectType"
                />
              </div>
            </div> -->




            <div class="form-group" >
              <label  class="control-label col-sm-3">Company</label>
              <div class="col-sm-5">
                <select
                  :disabled="formdata.ProjectRole==4"
                  type="select"
                  class="form-control"
                  name="ComID"
                  id="ComID"
                  v-model="formdata.ComID"
                >
                  <option v-for="item in lstComID" :value="item.ComID">{{ item.CompanyName }}</option>
                </select>
              </div>
            </div>


            <!-- <div class="form-group"  v-if="formdata.ProjectRole!=4"> -->
              <div class="form-group" >
              <label  class="control-label col-sm-3">Project manager</label>
              <div class="col-sm-5">
                <select
                  :disabled="formdata.ProjectRole==4"
                  type="select"
                  class="form-control"
                  name="ProjectManager"
                  id="ProjectManager"
                  v-model="formdata.ProjectManager"
                >
                  <option v-for="item in lstEmpID" :value="item.EmpID">{{ item.EmployeeID }}</option>
                </select>
              </div>
            </div>



            <!-- <div class="form-group" v-if="formdata.ProjectRole!=4"> -->
              <div class="form-group" >
              <label class="control-label col-sm-3">Project agreement no.</label>
              <div class="col-sm-5">
                <input
                  :disabled="formdata.ProjectRole==4"
                  type="text"
                  class="form-control"
                  name="ProjectAgreementNo"
                  id="ProjectAgreementNo"
                  v-model="formdata.ProjectAgreementNo"
                />
              </div>
            </div>




            <!-- <div class="form-group" v-if="formdata.ProjectRole!=4"> -->
            <div class="form-group">
              <label class="control-label col-sm-3">Proposal No.</label>
              <div class="col-sm-5">
                <!-- <input
                  :disabled="formdata.ProjectRole==4"
                  type="text"
                  class="form-control"
                  name="ProposalID"
                  id="ProposalID"
                  v-model="formdata.ProposalID"
                /> -->
                <select
                  :disabled="formdata.ProjectRole==4"
                  type="select"
                  class="form-control"
                  name="ProposalID"
                  id="ProposalID"
                  v-model="formdata.ProposalID"
                >
                  <!-- <option v-for="item in lstEmpID" :value="item.ProposalID">{{ item.ProposalID }}</option> -->
                  <option v-for="item in lstProposalID" :value="item.ProposalID">{{ item.ProposalNo }} : {{item.ProjectName }}</option>
                </select>
              </div>
            </div>



            <div class="form-group" >
              <label class="control-label col-sm-3" >Project status</label>
              <div class="col-sm-5">
                <select
                  type="select"
                  class="form-control"
                  name="ProjectStatus"
                  id="ProjectStatus"
                  v-model="formdata.ProjectStatus"
                >
                  <option v-for="item in lstProStatus" :value="item.ListID">{{ item.Str1 }}</option>
                </select>
              </div>
            </div>  


          <!-- </div> -->
          <!-- End Main row -->

          <!-- <div
            class="modal-footer clearfix"
            style="margin-top: 565px; margin-bottom: -10px; border-color:#cccccc; border-width: 0"
          >  -->
           <!-- <div class="form-group" >
            <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 275px; " >Close</button>
            <button type="submit" class="btn btn-primary" style="margin-left: 2px;background-color: #2a88bd" id="save">
              Save
              changes
            </button>
          </div> -->



          </div>
          <!-- end  modal body -->



          <div class="modal-footer" style="padding-bottom:20px;">
            <button type="submit" class="btn btn-primary" id="save">Save changes</button>
            <button @click="modalclosed" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>  

         <!-- this is used for clicking outside of modal which cannot be catched by modal buttons close event. so fired by jquery -->
        <!-- <h1 id="prohiddenmodalonhide" @click="modalonhide()" hidden>hiddenmodalonhide</h1>        -->
          
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


export default {
  name: "proeditmodal",
  data() {
    return {
      count: 0,

      lstProPRole:[],
      lstEmpID:[],
      lstProOCategory:[],
      lstComID: [],
      lstProjectType:[],
      lstCAOID:[],
      lstProStatus:[],
      lstProposalID:[],

      IE:false,

      image: "", //'/images/employee/AlthaverDB.jpg',

      offset: 4,
      formErrors: {},
      formErrorsUpdate: {},

    //GENERAL ERROR: Test if any error other than validation error(422 (Unprocessable Entity))
      // errstatus:false, //test
      // errstatusttext:'', //test   


      formdata: {

        ProjectNo:'',
        ProjectName:'', 
        ProjectRole:0, 
        AwardYear:'', 
        ProjectManager:0,
        OwnerCategory:0,
        ComID:0, 
        PrimaryProjectType:0, 
        SecondaryProjectType:'', 
        // SecondaryProjectType:[], 
        Owner:0, 
        Client:0, 
        ProjectAgreementNo:'', 
        ProjectStatus:0,
        ProposalID:0, 
        ProjectID:0,

      },

      // test:[1,3],
      secprojectarray:[],

      addmode:true, // to switch between updateitem and additem
      
    };
  },
  // props: ["empid"],


  methods: {

    changedtoIE(){

      // If IE is selected after entering data in the following disabled fields it has to be cleared
      if (this.formdata.ProjectRole===4) {
          this.formdata.ComID=0;
          this.formdata.ProjectManager=0;
          this.formdata.ProjectAgreementNo='';
          this.formdata.ProposalID=0;
      }
    },

    modalclosed(){
         this.formErrors="";
        //  this.errstatus=false;
        //  this.errstatusttext='';       
        //  to get a slidedown effect of errorbar with jquery
        // $("#protoperrbar").hide();
        $("#protoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition
    },


    // this is for clicking outside of modal which cannot be catched by modal buttons close event
    modalonhide(){
         this.formErrors="";
        //  $("#protoperrbar").hide();
        $("#protoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition  
         this.addmode=true; 
    },


    clearaddform(){
      // enable the IE option in addmode
      $('#ProjectRole option[value="4"]').attr("disabled", false);


      // ** Should clear formdata since it could be populated with previous edit data

        this.formdata.ProjectNo='';
        this.formdata.ProjectName=''; 
        this.formdata.ProjectRole=0; 
        this.formdata.AwardYear=''; 
        this.formdata.ProjectManager=0;
        this.formdata.OwnerCategory=0;
        this.formdata.ComID=0; 
        this.formdata.PrimaryProjectType=0; 
        this.formdata.SecondaryProjectType=''; 
        this.formdata.Owner=0; 
        this.formdata.Client=0; 
        this.formdata.ProjectAgreementNo=''; 
        this.formdata.ProjectStatus=0;
        this.formdata.ProposalID=0, 
        this.formdata.ProjectID=0;

        this.formErrors="";   
        this.errstatus=false;
        this.errstatusttext='';   
         
        // to get a slidedown effect of errorbar with jquery
        // $("#protoperrbar").hide();
        $("#protoperrbar").css("height", '0px'); // 0 height to hide the errbar for next css transition          
         
        this.addmode=true; // must set to true here for extra safety(since modal can hide by clicking outside of modal)

        // $("#multiproeditsecproject option:selected").prop("selected", false);// clear Bootstrap multiselect
        $("#multiproeditsecproject").multiselect("clearSelection");// clear Bootstrap multiselect
        $("#multiproeditsecproject").multiselect( 'refresh' );// refresh Bootstrap multiselect

    },


    loadeditdata(id) {
      // disable the IE option in editmode
      $('#ProjectRole option[value="4"]').attr("disabled", true);


      this.addmode=false
      // $("#multiproeditsecproject option:selected").prop("selected", false);// clear Bootstrap multiselect
         $("#multiproeditsecproject").multiselect("clearSelection");// clear Bootstrap multiselect
         $("#multiproeditsecproject").multiselect( 'refresh' );// refresh Bootstrap multiselect


      //to get edit data from databese instead of table row
      axios
        .get("apiproeditdata/" + id + "").then(response => {
          this.formdata = response.data[0];

       


            // $('#multiproeditsecproject').val(['1', '3','4']);
            // $('#multiproeditsecproject').val([1,3,4]).trigger('change');
            // var x=this.formdata.SecondaryProjectType;
            // $('#multiproeditsecproject').val([21]).trigger('change');

            // http://jsfiddle.net/Shef/gpSqc/
            // var valArr = [20],i = 0,size = valArr.length,$options = $('#multiproeditsecproject option');;
            // for(i=0; i < size; i++){
            //     $options.filter('[value="'+valArr[i]+'"]').prop('selected', true);
            //     $("#multiproeditsecproject").multiselect('rebuild'); // **IMPORTANT
            // }


          // var str = this.formdata.SecondaryProjectType;
          // this.secprojectarray = str.split(",");
          // $("#multiproeditsecproject").multiselect('rebuild'); // **IMPORTANT            


          // code for dynamically check Bootstrap multiselect from database SecondaryProjectType value
          var items=this.formdata.SecondaryProjectType;
          $.each(items.split(','), function(idx, val) {
              // $("#multiproeditsecproject option[value='"+val+"']").attr("selected", "selected");
              $("#multiproeditsecproject option[value='"+val+"']").prop('selected', true); // use prop for latest jquery
              $("#multiproeditsecproject").multiselect('rebuild'); // **IMPORTANT
          });





        })
        .catch(err => {
          console.log(err);
        });
 

    },



    // using same method and modal form for add and edit
   addupdateitem(){

      var s1=this.$usertype;
      var s2="admin";
      if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
        // alert("You don't have permission to run this operation");
        $("#globalunauthorisedmsg").modal("show");
        return;
      } 


     // convert array generated from multiselect dropdown to string for saving as secondaryproject type which is string
     var array=$("#multiproeditsecproject").val();
     var str = array + "";
     this.formdata.SecondaryProjectType=str;


     let apiurl=''

        if (this.addmode) {
          apiurl="apiproadddata/";
        } else {
          apiurl="apiproupdatedata/";
        }



            //  Foreign key is used in main table for List items col which has to set to null(instead of 0) 
            //  ONDELETE(when a list item row id deleted) as per mysql. 
            //  NOTE: All NULL values are automatically send to the controller as string '' which stores NULL in db 
            //  if default value for the field is NULL. So no need to convert the NULL values here. 
            //  Conversion is needed if FormData is used to send data to controller like Employee.


           // NOW USING AXIOS 
            axios.post(apiurl, this.formdata).then(response => {     
            // axios.post(apiurl, this.formdata).then((response) => { // if response data is needed before catch

                  $("#proeditmodal").modal("hide");

                  toastr.success("Item Updated Successfully.", "Success Alert", {
                    timeOut: 3000
                  });

                  // this.formErrors=""; now done in onmodalhide() // clear form error else will appear on the form
                  $('#projectTable').DataTable().ajax.reload(); // refresh parent table

                  // // now done in onmodalhide() 
                  // if (this.formErrors === "") {
                  //       this.addmode=true; // set to default true, For edit it is set to false in loadeditdata() method
                  //       console.log("Updated from addmode: "+ this.addmode);
                  // }                    

              })
              .catch((err) => {
                  console.log(err)

                  //axios Network Error doesnt have err.response.status, so used seperate condition
                   if (err.message==="Network Error") {
                        $("#proeditmodal").modal("hide");
                        toastr.error("Could not Save. "+ err.message, "Alert", {
                            timeOut: 5000 //3000
                        });
                        return;
                  }                    

                   if (err.response.status===422) { 
                        this.formErrors = err.response.data; // validation error(422 (Unprocessable Entity))
                        var totalerr=Object.keys(this.formErrors).length //count the number of properties(errors) in a JavaScript object
                        var height=30+(totalerr*20);
                        // $("#protoperrbar").css("height", height+'px');
                        // $('#protoperrbar').slideDown();

                        // $("#protoperrbar").css("transition", 'height 300ms'); // css transition instead of jquery to slide uo and down
                        $("#protoperrbar").css("height", height+'px');                       
                        // $('#protoperrbar').show();
                        return;
                  } 

                    // GENERAL ERROR: Test  if any error other than validation error(422 (Unprocessable Entity) or Network)
                    $("#proeditmodal").modal("hide");
                        toastr.error("Could not Save. "+ err.response.statusText + " : "+ err.message, "Alert", {
                        timeOut: 5000 //3000
                    });  


              });  // end catch



},





  // now using same method and modal form for add and edit
    updateItem(){


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
      $('#proeditmodal').on('hidden.bs.modal', function () {
        //  $('#prohiddenmodalonhide').click();
        self.modalonhide();
      });  

      // for SecondaryProjectType Multiselect dropdown
      // https://www.youtube.com/watch?v=q5jNAhYcHEI
      // this is placed outside of settime out Multiselect dropdown wont get the values if items are loaded after Multiselect dropdown is loaded
      //  this.$http
      //   .get("/api/apilstProjectType",{
      //         headers: {
      //             'Authorization': this.$apitoken
      //              }
      //         }).then(function(response) {

      //     this.lstProjectType = response.body;
      //         var data = [
      //             // {label: response.body[1].Str1, title: 'Option 1', value: response.body[1].ListID},
      //             // {label: 'Option 2', title: 'Option 2', value: '2'},
      //             // {label: 'Option 3', title: 'Option 3', value: '3'},
      //             // {label: 'Option 4', title: 'Option 4', value: '4'},
      //             // {label: 'Option 5', title: 'Option 5', value: '5'},
      //         ];
      //         for (var i = 1; i < this.lstProjectType.length; i++) { // note i started from 1 instead of 0 to exclude blank row
      //             var obj={label: this.lstProjectType[i].Str1, value: this.lstProjectType[i].ListID};
      //             data.push(obj);
      //         }

      //         $("#multiproeditsecproject").multiselect('dataprovider', data); 
      //   });  


        //  // NOW GLOBAL baseURL and Authorization Header is used
        //     axios.get("apilstProjectType").then((response) => {
        //       this.lstProjectType = response.data;
             
        //       var data = [
        //           // {label: response.body[1].Str1, title: 'Option 1', value: response.body[1].ListID},
        //           // {label: 'Option 2', title: 'Option 2', value: '2'},
        //           // {label: 'Option 3', title: 'Option 3', value: '3'},
        //           // {label: 'Option 4', title: 'Option 4', value: '4'},
        //           // {label: 'Option 5', title: 'Option 5', value: '5'},
        //       ];
        //       for (var i = 1; i < this.lstProjectType.length; i++) { // note i started from 1 instead of 0 to exclude blank row
        //           var obj={label: this.lstProjectType[i].Str1, value: this.lstProjectType[i].ListID};
        //           data.push(obj);
        //       }
        //      // placed here instead of mounted else dropdown wont fill after new project is searched 
        //      // also use different id for each multiselect to avoid conflict 



        //       $("#multiproeditsecproject").multiselect('dataprovider', data);


              // // placed here instead of mounted or $(document).ready else dropdown options wont fill from database in select tag 
              // // also use differenr id for each selectpicker to avoid conflict 
              // $('#multiproeditsecproject').multiselect({
              //   nonSelectedText: 'Select multiproeditsecproject',
              //   enableFiltering: true,
              //   enableCaseInsensitiveFiltering: true,
              //    maxHeight: 300,
              //    dropRight:false,
              //   // numberDisplayed: 2,

              //   includeSelectAllOption: true,
              //   buttonClass: 'showhide',
              //   nonSelectedText: 'Select Secondary Projects',
              //   enableClickableOptGroups: true,
              //   // buttonContainer: '<div style="height: 64px;" />',
              //   // selectAllText: 'Check all!'
              //   // buttonWidth:'400px'
              //   // buttonWidth:'323px'
              // });


              // }).catch((err) => {
              //     console.log(err)
              // });  





    setTimeout(() => {
      // set time is used to load combo after parent table is loaded to make table load fast


      // axios.get("/api/apilstJobTitle")
      //         .then((response) => {
      //             this.lstJobTitle = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });



      // axios.get("apilstProPRole").then((response) => {
      //             this.lstProPRole = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });  

      // axios.get("apilstEmpID").then((response) => {
      //             this.lstEmpID = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });  

      // axios.get("apilstProOCategory",).then((response) => {
      //             this.lstProOCategory = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });  


      // axios.get("apilstComID").then((response) => {
      //             this.lstComID = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });  


      // axios.get("apilstProjectType").then((response) => {
      //             this.lstProjectType = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });          


      // axios.get("apilstCAOID").then((response) => {
      //             this.lstCAOID = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });  


      // axios.get("apilstProStatus").then((response) => {
      //             this.lstProStatus = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });  


      // axios.get("apilstEmpProjectRole").then((response) => {
      //             this.lstEmpProjectRole = response.data
      //         }).catch((err) => {
      //             console.log(err)
      //         });  




      // now receiving all combo in one request under a group
      // ***********************************************************************
             this.$axios.get(this.$host+"api/procombo/pro").then((response) => {
            // axios.get("apiprocombogroup").then((response) => {
            //       this.lstProPRole = response.data.List_ProPRole;
            //       this.lstEmpID = response.data.Emp_Main;
            //       this.lstProOCategory = response.data.List_ProOCategory;
            //       this.lstComID = response.data.Com_Main;
            //       this.lstProjectType = response.data.List_ProjectType;
            //       this.lstCAOID = response.data.CAO_Main;
            //       this.lstProStatus = response.data.List_ProStatus;
            //       this.lstEmpProjectRole = response.data.List_EmpProjectRole;
            //       this.lstProposalID = response.data.Proposal_Main;

            //       // multiproeditsecproject. placed here instead of mounted else dropdown wont fill after new project is searched 
            //       // also use different id for each multiselect to avoid conflict 
            //       var data = [];
            //       for (var i = 1; i < this.lstProjectType.length; i++) { // note i started from 1 instead of 0 to exclude blank row
            //           var obj={label: this.lstProjectType[i].Str1, value: this.lstProjectType[i].ListID};
            //           data.push(obj);
            //       }
            //       $("#multiproeditsecproject").multiselect('dataprovider', data);


              }).catch((err) => {
                  console.log(err)
                  console.log("going");
              });         



    }, 2000); //2000); This promise will be resolved in 2000 milli-seconds

        // must place multiselect here so on every mount it gets the style
        $(document).ready(function() {

          // $('#multiproeditsecproject').multiselect({
          //   nonSelectedText: 'Select multiproeditsecproject',
          //   enableFiltering: true,
          //   enableCaseInsensitiveFiltering: true,

          //   includeSelectAllOption: true,
          //   buttonClass: 'showhide',
          //   nonSelectedText: 'Select Secondary Projects',
          //   enableClickableOptGroups: true,
          //   // buttonContainer: '<div style="height: 64px;" />',
          //   // selectAllText: 'Check all!'
          //   // buttonWidth:'400px'
          //   // buttonWidth:'323px'
          // });

        });


        // must place multiselect here so on every mount it gets the style
        $(document).ready(function() {
              $('#multiproeditsecproject').multiselect({
                // nonSelectedText: 'Select Framework',
                nonSelectedText: '',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                 maxHeight: 310,
                  dropRight:false,

                includeSelectAllOption: true,
                buttonClass: 'showhide',
                // nonSelectedText: 'Select Secondary Projects',
                // enableClickableOptGroups: true,
                // buttonContainer: '<div style="height: 64px;" />',
                // selectAllText: 'Check all!'
                // buttonWidth:'400px'
                // buttonWidth:'323px'
              });





        });


  } // mounted

};

</script>



<style>


/* search combo styles************************************ */
#proform .form-group{
  margin-bottom: 5px;
}

#proform select[type="select"] {
   height: 30px;
   width:440px;
   border-radius: 2px;
   color: #333;
   font-family: "Helvetica", Arial, sans-serif;
   /* margin-left: 20px; */
}
#proform label {
   padding-right:0px;
   font-family: "Helvetica", Arial, sans-serif;
}

#proform input[type="text"] {
   height: 30px;
   width:440px;
   border-radius: 2px;
   color: #333;
  font-family: "Helvetica", Arial, sans-serif;
  /* margin-left: 20px; */
}
/*align labels left*/
.form-horizontal .control-label{
    text-align: left;
    margin-bottom: 0px;
    font-size: 13px;
    color:black;
    font-family: "Helvetica", Arial, sans-serif;

    /* style="margin-right:0px;padding-left:30px;text-align:left;font-size: 13px; color:black;" */
}
/* END search combo styles************************************ */




/* Start Bootstrap Multiselect combo styles************************************ */

.multiproeditsecproject .multiselect{
  text-align: left;
    min-width: 440px;
    max-width: 440px;
    font-size: 13px;
    height: auto;
    min-height: 30px;
    /* margin-left: 20px; */

    background:transparent;
    border:1px solid #c5c5c5;
        color: #333;
        padding-left: 12px;
        padding-top: 6px;
        padding-bottom: 6px;
        border-radius: 2px;
}
.multiselect-clear-filter,.input-group-addon{
  padding:3px;
  padding-left: 8px;
   padding-right: 8px;
}

.multiproeditsecproject .caret{
  float:right !important;
}
/* to reduce the items height of multi dropdown */
#proform label  {
    /* margin-left: 0px; */
    padding-bottom: 0px;
    padding-top: 0px;
}

.multiselect-container li > a {
  
  height:22px;
  line-height: 1.5 !important;
}


</style>