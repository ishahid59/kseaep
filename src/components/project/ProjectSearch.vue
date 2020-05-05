<template>
  <div>


    <button type="button" v-on:click="showprocolselectormodal" class="btn btn-default pull-right btn-sm"
      style="margin-top:-3px;">
      <span class="glyphicon glyphicon-cog"></span> Settings
    </button>
    <h2 style="margin-top: 10px; margin-bottom: 5px; font-size:25px;">Project Search</h2>

    <div style="border: 1px solid #3c8dbc;">

        
        <!-- <img alt="Vue logo" src="./assets/logo.png" /> -->
        <procolselector v-bind:colsel="fields" />
        <!-- //empeditmodal NOT USED IN SEARCH FORM -->
        <!-- <empeditmodal v-bind:todo="employee" /> -->
        <!-- <empeditmodal v-if="parentloaded" /> -->

        <!--ref="editmodalcomponent" is used to call modal method from parent /> -->
        <!-- Editmodal component not needed in searcg form -->
        <!-- <empeditmodal ref="editmodalcomponent" v-bind:projectid="projectid" /> -->
        
        <input type="text"  id="prohiddenid"  hidden/> <!-- this will store the projectid on datatable row click -->
        <!-- <h1 id="hiddenopendetailpage" @click="openprodetailpage()" hidden>hiddenopendetailpage</h1>
        <h1 id="hiddenshoweditmodal" @click="showempeditmodal()" hidden>hiddenshoweditmodal</h1>
        <h1 id="hiddendeleteemp" @click="deleteemp()" hidden>hiddendeleteemp</h1> -->

        <!-- <div><img src="images/avatar5.png" alt=""></div> -->
        <!-- <span>Message: {{ user }}</span> -->



     <!-- TABLE BODY - Extra div for Styling Table Div -->
    <div class="table-body" style="padding:7px;padding-top: 8px;">

      <!-- SEARCH FORM DIV -->
      <div id="prosrccombo" class="container-fluid" style="padding-right:18px;padding-bottom:12px;padding-top:15px;">
        <form class="form-horizontal" id="srcform">

        <div class="col-xs-4" > 

            <div class="form-group"  >
              <label class="control-label col-sm-5">Company</label>
              <div class="col-md-7">
              <select type="select" class="form-control " name="ComID" id="srcComID" >
                <option v-for="item in lstComID" :value="item.ComID">{{ item.CompanyName  }}</option>
              </select>
            </div>
          </div>  


          <div class="form-group">
              <label class="control-label col-sm-5">Primary Project Type</label>
              <div class="col-md-7">
              <select type="select" class="form-control " name="PrimaryProjectType" id="srcPrimaryProjectType" >
                <option v-for="item in lstProjectType" :value="item.ListID">{{item.Str1  }}</option>
              </select>
            </div>
          </div>  


          <!-- <div class="form-group">
              <label class="control-label col-sm-5">Secondary Proj. Type</label>
              <div class="col-md-7">
              <select type="select" class="form-control " name="SecondaryProjectType" id="srcSecondaryProjectType" >
                <option v-for="item in lstProjectType" :value="item.ListID">{{item.Str1  }}</option>
              </select>
            </div>
          </div>   -->

            <!-- Bootstrap Multi select https://www.youtube.com/watch?v=sy7NQHcDsLk -->
            <!-- https://www.webslesson.info/2017/05/bootstrap-multi-select-dropdown-with-checkboxes-using-jquery-in-php.html -->
            <div class="form-group" >
              <label class="control-label col-sm-5">Sec/ Project Type</label>
              <div class="col-sm-7 multiprosearchsecproject" >
                  <!-- note: binding is not used since it needs array to check items -->
                  <select id="multiprosearchsecproject"  multiple class="form-control" >
                      <!-- filling items from combo fill api since options wont work here. v-model is not used. instead check items in method loadeditdata  -->
                      <!-- <option v-for="item in lstProjectType" :value="item.ListID">{{ item.Str1 }}</option> -->

                  </select>
              </div>
            </div>



          <div class="form-group">
              <label class="control-label col-sm-5">Employee</label>
              <div class="col-md-7">
              <select type="select" class="form-control " name="EmpID" id="srcEmpID" >
                <option v-for="item in lstEmpID" :value="item.EmpID">{{item.EmployeeID  }}</option>
              </select>
            </div>
          </div>  


          <div class="form-group">
              <label class="control-label col-sm-5">Emp. Project Role</label>
              <div class="col-md-7">
              <select type="select" class="form-control " name="EmpProjectRole" id="srcEmpProjectRole" >
                <option v-for="item in lstEmpProjectRole" :value="item.ListID">{{item.Str1  }}</option>
              </select>
            </div>
          </div>  

    </div> 
    <!-- end col 1 -->





    <div class="col-xs-4" > 

          <div class="form-group">
              <label class="control-label col-sm-4">Project Role</label>
              <div class="col-md-7">
              <select type="select" class="form-control " name="ProjectRole" id="srcProjectRole" >
                <option v-for="item in lstProPRole" :value="item.ListID">{{item.Str1  }}</option>
              </select>
            </div>
          </div>  

        <div class="form-group">
          <label class="control-label col-sm-4">Owner Category</label>
          <div class="col-md-7">
            <select type="select" class="form-control " name="OwnerCategory" id="srcOwnerCategory" >
              <option v-for="item in lstProOCategory" :value="item.ListID">{{ item.Str1  }}</option>
            </select>
        </div>
        </div>


        <div class="form-group">
          <label class="control-label col-sm-4">Owner</label>
          <div class="col-md-7">
            <select type="select" class="form-control " name="Owner" id="srcOwner" >
              <option v-for="item in lstCAOID" :value="item.CAOID">{{ item.Name  }}</option>
            </select>
        </div>
        </div>


        <div class="form-group">
          <label class="control-label col-sm-4">Client</label>
          <div class="col-md-7">
            <select type="select" class="form-control " name="Client" id="srcClient" >
              <option v-for="item in lstCAOID" :value="item.CAOID">{{ item.Name  }}</option>
            </select>
        </div>
        </div>

        <!-- <div class="form-group">
          <label class="control-label col-sm-4 ">Experience</label>
          <div class="col-md-7">
          <input type="text" class="form-control">
        </div>
        </div> -->

        <div class="form-group">
              <label class="control-label col-sm-4">Project Status</label>
              <div class="col-md-7">
              <select type="select" class="form-control " name="ProjectStatus" id="srcProjectStatus" >
                <option v-for="item in lstProStatus" :value="item.ListID">{{item.Str1  }}</option>
              </select>
            </div>
        </div>  



    </div>  
    <!--  end co2  -->


    <div class="col-xs-4" style="padding-left:0px;" > 



      <div class="form-group">
        <label class="control-label col-sm-5 ">Firm Fee($1,000)</label>
        <div class="col-md-7">
            <div class="row">
                <div class="form-group col-xs-5" style="margin-bottom:0px;">
                         <select type="select" class="form-control" name="FirmFee" id="srcFirmFeeOperator" >
                            <option>  </option>
                            <option> &lt; </option>
                            <option>&lt;=</option>
                            <option>=</option>
                            <option>&gt;=</option>
                            <option>&gt;</option>
                        </select>
                </div>
                <div class="form-group col-xs-7" style="margin-bottom:0px;">
                         <input type="text" id="srcFirmFee" class="form-control" style="margin-left:5px;width:160px;">
                </div>
            </div>
       </div>
     </div>



     <div class="form-group">
        <label class="control-label col-sm-5 ">Const. Cost($1,000)</label>
        <div class="col-md-7">
            <div class="row">
                <div class="form-group col-xs-5" style="margin-bottom:0px;">
                         <select type="select" class="form-control" name="ConstCost" id="srcConstCostOperator" >
                            <option> </option>
                            <option> &lt; </option>
                            <option>&lt;=</option>
                            <option>=</option>
                            <option>&gt;=</option>
                            <option>&gt;</option>
                        </select>
                </div>
                <div class="form-group col-xs-7" style="margin-bottom:0px;">
                         <input type="text" id="srcConstCost"  class="form-control" style="margin-left:5px;width:160px;">
                </div>
            </div>
       </div>
     </div>



     <div class="form-group">
        <label class="control-label col-sm-5 ">Experience Start Date</label>
        <div class="col-md-7">
            <div class="row">
                <div class="form-group col-xs-5" style="margin-bottom:0px;">
                         <select type="select" class="form-control" name="ExpStartDate" id="srcExpStartDateOperator" >
                            <option></option>
                            <option> &lt; </option>
                            <option>&lt;=</option>
                            <option>=</option>
                            <option>&gt;=</option>
                            <option>&gt;</option>
                        </select>
                </div>
                <div class="form-group col-xs-7" style="margin-bottom:0px;">
                         <input type="date" id="srcExpStartDate" class="form-control" style="margin-left:5px;width:160px;">
                </div>
            </div>
       </div>
     </div>


     <div class="form-group">
        <label class="control-label col-sm-5 ">Experience End Date</label>
        <div class="col-md-7">
            <div class="row">
                <div class="form-group col-xs-5" style="margin-bottom:0px;">
                         <select type="select" class="form-control" name="ExpEndDate" id="srcExpEndDateOperator" >
                            <option></option>
                            <option> &lt; </option>
                            <option>&lt;=</option>
                            <option>=</option>
                            <option>&gt;=</option>
                            <option>&gt;</option>
                        </select>
                </div>
                <div class="form-group col-xs-7" style="margin-bottom:0px;">
                         <input type="date" id="srcExpEndDate" class="form-control" style="margin-left:5px;width:160px;">
                </div>
            </div>
       </div>
     </div>



            <div class="form-group" style="margin-top:0px;line-height:1px;" >
              <div class="col-sm-1">
                  <!-- note: ":true-value="1" should be used to tellchkbox for which value it should be checked -->
                  <input
                   :true-value="1" 
                    type="checkbox"
                    name="ExcludeIEProjects"
                    id="srcExcludeIEProjects"
                    style="margin-top:9px;"
                  />
              </div>
              <label for="srcExcludeIEProjects"  class="control-label col-sm-8" style="padding-left:0px;padding-top:15px; cursor:pointer">Exclude IE Projects</label>
            </div>

            <div class="form-group" style="line-height:1px;" >
              <div class="col-sm-1">
                  <!-- note: ":true-value="1" should be used to tellchkbox for which value it should be checked -->
                  <input
                   :true-value="1" 
                    type="checkbox"
                    name="ExcludeOngoingProjects"
                    id="srcExcludeOngoingProjects"
                    style="margin-top:9px;"
                  />
              </div>
              <label for="srcExcludeOngoingProjects" class="control-label col-sm-8" style="padding-left:0px;padding-top:15px; cursor:pointer">Exclude Ongoing Projects</label>
            </div>






            </div>  
            <!--  end co3 -->



      </form>


    </div>  
     <!-- end prosrccombo div container-fluid -->



 
 <!-- end Search prosrccombo ************************************************ -->


























             <button @click="srcreset" class="btn btn-default btn-sm pull-right" style="width: 70px;margin-right:0px;margin-top:0px;margin-bottom:6px;"><span aria-hidden="true" class="glyphicon glyphicon-refresh"></span> Reset</button>
             <button @click="search"   class="btn btn-primary btn-sm pull-right" style="margin-top:0px;margin-right:5px;width: 80px;background-color: #2a88bd">Search</button> 



        <table id="proSearchTable" class="table table-striped table-bordered" style="width:100%; ">
          <thead>
            <tr>
              <th>ProjectID</th>
              <th>Project no.</th>
              <th>Project name</th>
              <th>Project role</th>
              <th>Award year</th>
              <th>Project manager</th>
              <th>Owner category</th>
              <th>Company</th>
              <th>Primary project type</th>
              <th>Secondary project type</th>
              <th>Owner</th>
              <th>Client</th>
              <th>Project agreement no.</th>
              <th>Project status</th> 
              <th>ProposalID</th> 
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- end panel body -->
    </div>
    <!-- end panel -->
  </div>
</template>



<script>
import procolselector from "./ProColSelector.vue";
import proeditmodal from "./ProEditModal.vue";
import axios from "axios";

// now called globally in app.js
// import moment from 'moment'; //used to format date in datatable


export default {
  name: "projectsearch",
  components: {
    procolselector,
    proeditmodal
  },
  data() {
    return {
      // editformcomboloaded: false,
      projectid: 0,
      count: 0, //test

    //   employees: [],
    //   employee: {
    //     id: 0,
    //     email: "rrrr",
    //     title: "rrrr"
    //   },
       fields: [
        {
          name: "id", // name property  used in route list to use with parameter
          visible: true
        }
      ],
      lstProPRole:[],
      lstEmpID:[],
      lstProOCategory:[],
      lstComID: [],
      lstProjectType:[],
      lstCAOID:[],
      lstProStatus:[],
      lstEmpProjectRole:[],

        // lstJobTitle: [],
        // lstDepartment: [],
        // lstRegistration: [],
        // lstDisciplineSF330: [],
        // lstDisciplineSF254: [],
        // lstEmployeeStatus: [],
        // lstComID: [],
        // lstEmpDegree: [],

        // lstEmpTraining:[],
        // lstCAOID:[],
        // lstProOCategory:[],
        // lstProjectType:[],
        // lstEmpProjectRole:[],



    //   image: "", //'/images/employee/AlthaverDB.jpg',
    //   test:false,
    //   offset: 4,
    //   formErrors: {},
    //   formErrorsUpdate: {},

      user:"", // to get username used to get role for view/edit permission
    //   testview:false
      
    };
  },

  methods: {

    // NOT USED IN SEARCH FORM
    // showempeditmodal() {
    //   // var table = $("#proSearchTable").DataTable();
    //   // var rowdata;

    //   //$("#proSearchTable tbody").on("click", "tr", function() {
    //   // rowdata = table.row(this).data();
    //   // $("#id").val(rowdata.id);
    //   // $("#EmployeeID").val(rowdata.employeeid);
    //   // $("#Firstname").val(rowdata.firstname);
    //   // $("#Lastname").val(rowdata.lastname);
    //   // $("#Jobtitle").val("Accountant");
    //   //});

    //   // to load modal combo only when edit button is clicked, to load after parent is loaded and not to repeat combo loading
    //   // if (this.editformcomboloaded == false) {
    //   //   this.$refs.editmodalcomponent.loadcombo();
    //   //   this.editformcomboloaded = true;
    //   // }

    //   //to get edit data from databese in child instead of table row
    //   this.projectid = $("#hiddenid").val();
    //   // console.log(this.projectid);
    //   this.$refs.editmodalcomponent.loadeditdata(this.projectid);


    //   $("#empeditmodal").modal("show");
    // },




    // NOT USED IN SEARCH FORM
    // showempaddmodal() {

    //   $('#empform').trigger("reset");
    //   // $('#empform')[0].reset();
    //   this.$refs.editmodalcomponent.clearaddform();      
    //   $("#empeditmodal").modal("show");

    // },



    openprodetailpage() {

      // this.projectid = $("#prohiddenid").val(); // this.projectid now set in mounted under table click

      // this.projectid = $("#hiddenshoweditmodal").html();
      // console.log(this.projectid);
      // code to open empdetail page router view by passing the projectid value
      // this.$router.push('empdetail', {params: { projectid: 5}})



      //  this.$router.push('empdetail')
      this.$router.push({
        name: "prodetail", // name property of this route must be used in route list to use with parameter
        params: { projectid: this.projectid },
        query:{this: this.projectid} // query param is used to pass projectid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
      });


    },

    // NOT USED IN SEARCH FORM
    // deleteemp() {
    //   this.projectid = $("#hiddenid").val();
    //   axios
    //     .post("/api/apiempdeletedata/" + this.projectid + "")
    //     .then(response => {
    //       // this.formdata = response.data[0];
    //       $('#proSearchTable').DataTable().ajax.reload(); // refresh parent table
            

    //     })
    //     .catch(err => {
    //       console.log(err);
    //     });

    // },

    showprocolselectormodal() {
      $("#procolselectormodal").modal("show");
    },

    search(){
         var table= $('#proSearchTable').DataTable();
            table.ajax.reload();

    },

    srcreset(){

            // clear multiselect dropdown
            $("#multiprosearchsecproject").multiselect("clearSelection");// clear Bootstrap multiselect
            $("#multiprosearchsecproject").multiselect( 'refresh' );// refresh Bootstrap multiselect
                  
             $('#srcform')[0].reset();
            //  $('#srcform').trigger("reset");     
            var table = $('#proSearchTable').DataTable();
            table.search('').columns().search('').draw();//clear datatable search filter
            table.ajax.reload();
            // (this).blur();// to move focus from btn
    }

  
  },

  mounted() {

    var token=this.$apitoken;// for api protection api_token is saved globally in app.js and use here
    var baseurldt=this.$baseURLdt;

     // call vue data inside jquery ,no need for hidden element click for indirect call
      // https://stackoverflow.com/questions/45092051/cannot-use-jquery-plugin-inside-vuejs-component

      var self = this;

      // Datatable action col click events now from mounted instead of hidden button click
      // instead of "$("#empview").click(function(){"  use "$("#employeeTable").on("click", "#empview", function(){" for dt action button click


      $("#proSearchTable").on("click", "#prosrcview", function(){
          self.projectid=$("#prohiddenid").val();
          self.openprodetailpage();
      });



    $(document).ready(function() {


      //alert(XSRF-Token.val());
      $("#proSearchTable").DataTable({
            processing: true, // make it false, sometimes for this table gives ajax error on load
            serverSide: true,
            "lengthMenu": [[15, 25, 50, 100, -1], [15, 25, 50, 100, "All"]],
            order: [[1, "asc"]], // used for default sort col
            searching: false, // to hide filter box
            language: {
                    processing: "<img src='images/ajax-loader.gif'>",
                    //  "loadingRecords": ""
            },

            // BUTTONS
            dom: 'Blfrtip',//** add "l" after B to show pagelength which hides after button add
            // "dom": '<"top"Bf>rt<"bottom"lip><"clear">',
            buttons: [
                // 'pageLength','copy', 'csv', 'excel', 'print',
                 {
                    extend: 'excelHtml5',
                    title: 'Excel',
                    text: '<div style="font-size:14px;padding:0;"><img src="images/excel.png" alt="" style="height:16px;"><span class="glyphicon excel"></span> Export to excel</div>',
                //     //Columns to export
                //     //exportOptions: {
                //     //     columns: [0, 1, 2, 3,4,5,6]
                //     // }
                 },
                // {
                //     extend: 'pdfHtml5',
                //     title: 'PDF',
                //     // text: 'Export to PDF'
                //     text:'<a href="/kseprojects/create_project" style="margin-left: 8px;"><img src="/media/icons/pdf-icon-18-bw.png" alt=""></i></a>'
                //     //Columns to export
                //     //exportOptions: {
                //     //     columns: [0, 1, 2, 3, 4, 5, 6]
                //     //  }
                // }
            ],

        ajax: {
          //url:"/kseprojects/empapi/",
          //url: "/Employee/apiemployeedata",
          // url: "/api/apiprosearchdata",
          // url: baseurldt+"apiprosearchdata",
          url: self.$host + "api/project/search", //FOR local Node-Js Backend
          //url:"http://kseng.com/laravelroot2/Employee/testposts/",
          //url:"/datatable/getposts",

          //https://laravel.io/forum/04-10-2017-laravel-datatable-and-tokenmismatchexception-in-verifycsrftokenphp-line-68
          headers: {
            // "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            'Authorization' : token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
          },

          // "dataSrc":"", //for non serverside processing
          //  https://datatables.net/reference/option/ajax.data
          //  contentType: "json",//"application/json",

          // **IMPORTANT Must use dataType: "JSON" instead of contentType: "json", to get the parameters in controlers
          // https://github.com/yajra/laravel-datatables/issues/1214
          dataType: "JSON",

          // **MAKE the dqatatable api POST since get request sql gets boig and cannot handle more than 9 cols
          // type: "GET",
          type: "POST",

          //**for datatable MUST send data in this format when server side processing for custon search parameters
          data: function(d) {
            //*** */note have to rename id for JobTitle to avoid conflict with empeditmodal component

            d.comid = $('#srcComID').val();  
            d.primaryprojecttype = $('#srcPrimaryProjectType').val();
            // d.secondaryprojecttype = $('#SecondaryProjectType').val();
            d.projectrole = $('#srcProjectRole').val();
            d.ownercategory = $('#srcOwnerCategory').val();
            d.owner = $('#srcOwner').val();
            d.client = $('#srcClient').val();
            d.projectstatus = $('#srcProjectStatus').val();
            d.empid = $('#srcEmpID').val();            
            d.empprojectrole = $('#srcEmpProjectRole').val();

            //d.firmfeeoperator = $("#FirmFeeOperator :selected").val();
            d.firmfeeoperator = $('#srcFirmFeeOperator :selected').text();
            d.firmfee = $('#srcFirmFee').val();            

            d.constcostoperator = $('#srcConstCostOperator :selected').text();
            d.constcost = $('#srcConstCost').val();

            d.expstartdateoperator = $('#srcExpStartDateOperator').val();
            d.expstartdate = $('#srcExpStartDate').val();
            d.expenddateoperator = $('#srcExpEndDateOperator').val();
            d.expenddate = $('#srcExpEndDate').val();

            // d.excludeieprojects = $('#srcExcludeIEProjects').val();
            if ($('#srcExcludeIEProjects').is(":checked"))
            {
              d.excludeieprojects =1
            }
            else{
              d.excludeieprojects =0
            }
            // d.excludeongoingprojects = $('#srcExcludeOngoingProjects').val();
            if ($('#srcExcludeOngoingProjects').is(":checked"))
            {
              d.excludeongoingprojects =1
            }
            else{
              d.excludeongoingprojects =0
            }

            d.secondaryprojecttype = $('#multiprosearchsecproject').val();

          }
        },
        responsive: true,
     columns: [


          {
            // data: "id",
            data: "ProjectID",
            visible: false
          },
          {
            data: "ProjectNo",
            render: function(data, type, row) {
                // return ( "<a  onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddenopendetailpage').click(); style='cursor:pointer'>"+data +"</a>")
                return ( "<a  onclick=$('#prohiddenid').val("+row.ProjectID +"); id='prosrcview' style='cursor:pointer'>"+data +"</a>")

            }
          },

          { "data": "ProjectName","mRender": function(data, type, row) {
                 if(data.length > 35){
                   var trimmedString = data.substring(0, 35);
                       return   trimmedString + '...';
                 } else {
                       return data;
                 }
           }},

          {
            data: "disProjectRole",
            visible: false
            //   width: "80px",
          },
          {
            data: "AwardYear",
            //   width: "80px",
            // visible: false
          },

          {
            data: "disProjectManager",
            visible: false
            //   width: "150px",
            // "defaultContent": "" // to avoid showing error on null values
          },
          {
            data: "disOwnerCategory",
            // "defaultContent": "",
            visible: false
          },
          {
            data: "disComID",
            visible: false,
            // defaultContent: ""
            //visible: false
          },
          // {
          //   data: "PrimaryProjectType",
          //   defaultContent: ""
          //   //visible: false
          // },
          { "data": "disPrimaryProjectType","defaultContent": "","mRender": function(data, type, row) {
                 if(data.length > 20){
                   var trimmedString = data.substring(0, 20);
                       return   trimmedString + '...';
                 } else {
                       return data;
                 }
           }},
          {
            data: "SecondaryProjectType",
            defaultContent: "",
            visible: false
          },
          // {
          //   data: "Owner",
          //   // defaultContent: ""
          //   //visible: false
          // },
          { "data": "disOwner","mRender": function(data, type, row) {
                 if(data.length > 22){
                   var trimmedString = data.substring(0, 22);
                       return   trimmedString + '...';
                 } else {
                       return data;
                 }
           }},
          {
            data: "disClient",
            visible: false
            // defaultContent: ""
            //visible: false
          },
          {
            data: "ProjectAgreementNo",
            visible: false
            // defaultContent: ""
            //visible: false
          },
         {
            data: "disProjectStatus",
            // defaultContent: ""
            // visible: false
          },
         {
            data: "disProposalID",
            // defaultContent: ""
            visible: false
          },

          {
            data: "ProjectID",
            // width: "100px",
            searchable: false,
            orderable: false,
            visible: false,
            render: function(data, type, row) {
              // return "<a href='/kseprojects/update_employee/'"+ data +"'/>Edit</a>"
              // return "<a  href='/kseprojects/update_employee/" + data + "'>Edit</a>"

              //return "<a  href='/kseprojects/employee_detail/" + data + "'>View</a> | <a  href='/kseprojects/update_employee/" + data + "/'>Edit</a>"

              return (
                // " <a onclick='openprodetailpage(" +
                // row.ProjectID +
                // ");' style='cursor:pointer'>View</a> | <a onclick='showproeditmodal(" +
                // row.ProjectID +
                // ");' style='cursor:pointer'>Edit</a>"


                 // ** with inline jquery no need to call function from outside vue(masterpage)
                 // not using now in search
                //"<a onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddenopendetailpage').click(); style='cursor:pointer'>View</a> | <a onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddenshoweditmodal').click(); style='cursor:pointer'>Edit</a> | <a onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddendeleteemp').click(); style='cursor:pointer'>Delete</a>"
                ""

              );
            }
          }
        ]

      });




      // ColSelector method, Column visibility
      // Following code can be used to hide action column as per user role
      $("input.vis").on("click", function(e) {
        //e.preventDefault(); checkbox will not chk with this line
        var table = $("#proSearchTable").DataTable();
        // Get the column API object
        var column = table.column($(this).attr("data-column"));
        // Toggle the visibility
        column.visible(!column.visible());
      });


        // now applyed with vue method srcreset()
        // $('#reset').on('click', function () {
        //     // $('#empSearchForm')[0].reset();
            
        //     var table = $('#proSearchTable').DataTable();
        //     table.search('').columns().search('').draw();//clear datatable search filter
        //     table.ajax.reload();
        //     (this).blur();// to move focus from btn
        // });



      

    }); // document

    


 this.user=$("#username").html();// to get username used to get role


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
        //       $("#multiprosearchsecproject").multiselect('dataprovider', data); 


              // // placed here instead of mounted or $(document).ready else dropdown options wont fill from database in select tag 
              // // also use differenr id for each selectpicker to avoid conflict 
              // $('#multiprosearchsecproject').multiselect({
              //   nonSelectedText: 'Select Framework',
              //   enableFiltering: true,
              //   enableCaseInsensitiveFiltering: true,

              //   includeSelectAllOption: true,
              //   buttonClass: 'showhide',
              //   nonSelectedText: 'Select Secondary Projects',
              //   // enableClickableOptGroups: true,
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


      // axios.get("apilstProOCategory").then((response) => {
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
              
      //  axios.get("apilstCAOID").then((response) => {
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

            axios.get("apiprosearchcombogroup").then((response) => {
                  this.lstProPRole = response.data.List_ProPRole;
                  this.lstEmpID = response.data.Emp_Main;
                  this.lstProOCategory = response.data.List_ProOCategory;
                  this.lstComID = response.data.Com_Main;
                  this.lstProjectType = response.data.List_ProjectType;
                  this.lstCAOID = response.data.CAO_Main;
                  this.lstProStatus = response.data.List_ProStatus;
                  this.lstEmpProjectRole = response.data.List_EmpProjectRole;

             
                  // multiprosearchsecproject. placed here instead of mounted else dropdown wont fill after new project is searched 
                  // also use different id for each multiselect to avoid conflict 
                    var data = [];
                    for (var i = 1; i < this.lstProjectType.length; i++) { // note i started from 1 instead of 0 to exclude blank row
                        var obj={label: this.lstProjectType[i].Str1, value: this.lstProjectType[i].ListID};
                        data.push(obj);
                    }
                    $("#multiprosearchsecproject").multiselect('dataprovider', data); 


              }).catch((err) => {
                  console.log(err)
                  console.log("going");
              });         



    }, 2000); // This promise will be resolved in 2000 milli-seconds


        // must place multiselect here so on every mount it gets the style
        $(document).ready(function() {
              $('#multiprosearchsecproject').multiselect({
                // nonSelectedText: 'Select Framework',
                nonSelectedText: '',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                 maxHeight: 350,
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


  }, // mounted


}; // export default
</script>




<style>
#app {
  /* font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: left;
  margin-top: 60px; */
  /* color: #2c3e50; */

  
  font-family: "Helvetica", Arial, sans-serif;
}

#prosrccombo{
  /* height:240px; */
  height: auto;
  padding:0px;
  padding-top: 15px;
  /* padding-left:15px; */
  margin:0px;
  margin-bottom: 10px; 
  border: 1px solid lightgrey; 
  background-color: #f1f1f1; 
}


/* search prosrccombo styles************************************ */

#prosrccombo .form-group {
  margin-bottom: 5px;
}
#prosrccombo label{
  /* padding-right: 0px;
  padding-left: 0px; */
  /* margin-left: 0px; */
}



#prosrccombo .form-group{
  margin-bottom: 5px;
  /* margin-left: 0px; */
}

#prosrccombo select[type="select"] {
   height: 27px;
   border-radius: 0px;
}

#prosrccombo input[type="text"] {
   height: 30px;
   border-radius: 0px;
   /* font-size: 14px; */
}
#prosrccombo input[type="date"] {
   height: 30px;
   border-radius: 0px;
   /* font-size: 14px; */
}
/*align labels left*/
.form-horizontal .control-label{
    text-align: left;
    margin-bottom: 0px;
    font-size: 12px;
    color:black;
    padding-top: 4px;
    font-weight: normal;
}
/* END search prosrccombo styles************************************ */



/* not working in common css so put in one of the component */
/* class for processing img, to remove the box around the image */
.dataTables_processing{
  position: absolute;
  border: none;
  background: transparent;
}
.dataTables_info{
      float: left;
    }

/* styling for Export button styling */
#proSearchTable_filter{
  /* float:left;
  margin-left:741px; */
}

#proSearchTable_length{
  float:left;
  margin-left:10px;
}
#proSearchTable_filter>label,#proSearchTable_length>label{
  margin-bottom:0px;
}



/* Export button styling */

button.dt-button, div.dt-button,a.dt-button {
    position: relative;
    /* position: absolute; */
    display: inline-block;
    box-sizing: border-box;
    margin-right: 0.333em;
    margin-bottom: 0.333em;
    padding: 0.5em 1em;
    /* border: 1px solid #999; */
    border: 1px solid #bebebe;
    border-radius: 2px;
    cursor: pointer;
    font-size: 0.88em;
    line-height: 1.6em;
    /* color: black; */
     color: #555555;
    white-space: nowrap;
    overflow: hidden;
    background-color: #e9e9e9;
    padding:5px;
    padding-left: 6px;
    padding-right: 6px;
    /* border: none; */
    background: transparent;
    }






/* Start Bootstrap Multiselect combo styles************************************ */

.multiprosearchsecproject .multiselect{
  text-align: left;
    min-width: 178px;
    max-width: 217px;
    font-size: 13px;
    height: auto;
    min-height: 30px;

        background-color:white;
        border:1px solid #cfcfcf;
        color: #333;
        padding-left: 12px;
        padding-top: 6px;
        padding-bottom: 6px;
        border-radius: 2px;

}

.multiselect-clear-filter, .input-group-addon{
  padding:3px;
  padding-left: 8px;
   padding-right: 8px;
}

/* move the arrow right */
.multiprosearchsecproject .caret{
  float: right !important;

}
/* to reduce the items height of multi dropdown */
#prosrccombo label {
    padding-bottom: 0px;
    padding-top: 0px;
}

/* to reduce the items height of multi dropdown */
.multiselect-container li > a {
  height:22px;
  line-height: 1.5 !important;
}

</style>

