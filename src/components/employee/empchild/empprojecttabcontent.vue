<template>
  <div>

    <!-- proteamdetailmodal -->

    <!-- Start Detail Modal ********************************************* -->
    <div class="modal fade" id="empprojectdetailmodal" role="dialog">
      <div class="modal-dialog" style=" width:800px">
        <!-- Modal content-->
        <div class="modal-content">

          <div class="modal-header"
            style="background-color: #f1f1f1; border-radius: 5px 5px 0 0; border-bottom: 1px solid lightgrey; height: 52px; ">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Project Team Detail</h4>
          </div>

          <div class="modal-body" id="details" style="padding:30px;padding-top:20px; padding-bottom:0px;">
            <dl class="dl-horizontal" style="margin-bottom:0px;">
              <dt>EmployeeID</dt>
              <dd id="ddEmployeeID">{{proteam.EmployeeID}}</dd>
              <dt>Project No.</dt>
              <dd id="ddProjectNo">{{proteam.ProjectNo}}</dd>
              <dt>Project Name</dt>
              <dd id="ddEmpProjectRole">{{proteam.ProjectName}}</dd>
              <dt>Employee Project Role</dt>
              <dd id="ddEmpProjectRole">{{proteam.disEmpProjectRole}}</dd>
              <dt>Secondary Project Role</dt>
              <dd id="ddSecProjectRole">{{proteam.disSecProjectRole}}</dd>
              <dt>Duration From</dt>
              <dd id="ddDurationFrom">{{proteam.DurationFrom}}</dd>
              <dt>Duration To</dt>
              <dd id="ddDurationTo">{{proteam.DurationTo}}</dd>
              <dt>Months of Experience</dt>
              <dd id="ddMonthsOfExp">{{proteam.MonthsOfExp}}</dd>
              <dt>Created at</dt>
              <dd id="ddcreatedat">{{proteam.created_at}}</dd>

              <dt>Updated at</dt>
              <dd id="ddupdatedat">{{proteam.updated_at}}</dd>
              <dt>Duties & Responsibilities</dt>
              <dd id="ddDutiesAndResponsibilities" style="margin-bottom:20px;line-height:1.65">
                {{proteam.DutiesAndResponsibilities}}</dd>
              <dt>Notes</dt>
              <dd id="ddNotes" style="line-height:1.65">{{proteam.Notes}}</dd>
            </dl>
          </div>
          <!--  end detail and modal body-->`


          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          <!-- end modal-footer -->

        </div>
        <!-- modal-content -->
      </div>
      <!-- end div modal dialog -->
    </div>
    <!-- End Detail Modal ********************************************************-->


    <!-- <a id="btnAddModal" href="{% url 'create_empdegree' 1 %}" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;" onclick="addEditEmpDegree(0)"><i class="fa fa-plus"></i> Add New</a>   -->
    <!-- <a id="btnAddModal" style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;" v-on:click="showempregaddmodal"><i class="fa fa-plus"></i> Add New</a> -->
    <a @click="forviewonlymsg" id="btnAddModal"
      style="float:right;margin-right:5px;margin-top:-22px;cursor:pointer;color:#006fae;"><i class="fa fa-info-circle"
        aria-hidden="true"></i> For view only</a>

    <!-- <table id="empdegreeTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
    <table id="empProjectTable" class="table table-striped table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th hidden="hidden">ProjectID</th>
          <th> Project no.</th>
          <th> Project name</th>
          <th>Project role</th>
          <th>Secondary project role</th>
          <th>Duties & responsibilities</th>
          <th>From</th>
          <th>To</th>
          <th>Months</th>
          <th>Notes</th>
          <th>EmpID</th>
          <th hidden="hidden">ID</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>

    <input type="text" id="projecthiddenid" hidden /> <!-- hyperlink project detail page will store projectid-->
    <!-- <h1 id="projecthiddenopendetailpage" @click="openprojectdetailpage()" hidden>hiddenopendetailpage</h1> -->
    <input type="text" id="empprojecthiddenid" hidden />
    <!-- <h1 id="empprojecthiddenopendetailpage" @click="openempprojectdetailpage()" hidden>hiddenopendetailpage</h1> -->
    <!-- hidden p to get emp id employee_detail.html passed from from view 'employee_degree' -->
    <!-- <p id="empprojecthiddenempid" style="display: none">{{empid}}</p> -->

  </div>
</template>


<script>

  // import moment from 'moment';
  // import axios from "axios";

  export default {
    name: "empprojecttabcontent",
    components: {

    },
    data() {
      return {
        empid: 0, // this EmpID of Employee
        id: 0,    // this is ID col value of Pro_Team table
        projectid: 0, // this is ProjectID col value of Pro_Team table
        proteam: {},
      };
    },

    methods: {

      forviewonlymsg() {
        alert("Employee projects tab is for view only. This table is showing all the projects where this employee has worked as a team member. \n\nTo add this employee to another project, go to project team tab under any project detail page. You can also edit employee project role by clicking on Project no. link in this tab.");
      },

      openprojectdetailpage() {
        // this.projectid = $("#projecthiddenid").val(); // this.projectid now set in mounted under table click

        // this.projectid = $("#hiddenshoweditmodal").html();
        // code to open prodetail page router view by passing the projectid value
        // this.$router.push('prodetail', {params: { projectid: 5}})

        //  this.$router.push('prodetail')
        this.$router.push({
          name: "prodetail", // name property of this route must be used in route list to use with parameter
          params: { projectid: this.projectid },
          query: { this: this.projectid } // query param is used to pass projectid to detail page to use it for refresh(id is lost in detail page when page is refreshed)
        });
      },

      openempprojectdetailpage() {
        // this.id = $("#empprojecthiddenid").val(); // this.id now set in mounted under table click

        this.$axios
          // .get("ksep/api/apiempprojectdetaildata/" + this.id + "")
          // .get("apiproteamdetaildata/" + this.id + "").then(response => {
            .get(this.$host+"api/empprojects/view/" + this.id + "").then(response => {
          
            // this.proteam = response.data[0];
             this.proteam = response.data;

            // // NOT NEEDED NOW  since sending date from controller in converted format (using carbon 'm/d/Y')
            // // to show hiredate in detail modal in mm/dd/yyyy format
            //     // to show date in detail modal in mm/dd/yyyy format
            //     if (this.proteam.DurationFrom!==null) {
            //         let userDate = this.proteam.DurationFrom;//'1999-02-13 00:00:00';
            //         var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");
            //         this.proteam.DurationFrom=date_string;
            //     }
            //     if (this.proteam.DurationTo!==null) {
            //         let userDate = this.proteam.DurationTo;//'1999-02-13 00:00:00';
            //         var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");
            //        this.proteam.DurationTo=date_string;
            //     }

            //     // to show blank in detail modal if date is default '1900-01-01 00:00:00'
            //     if (this.proteam.DurationFrom=='01/01/1900') {
            //         this.proteam.DurationFrom="";
            //         // $("#ddDurationFrom").html('');
            //     }
            //     if (this.proteam.DurationTo=='01/01/1900') {
            //         this.proteam.DurationTo="";
            //         // $("#ddDurationTo").html('');
            //     }
            //     if (this.proteam.created_at!=null) {
            //         let userDate = this.proteam.created_at;//'1999-02-13 00:00:00';
            //         var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
            //         this.proteam.created_at=date_string;
            //     }
            //     if (this.proteam.updated_at!=null) {
            //         let userDate = this.proteam.updated_at;//'1999-02-13 00:00:00';
            //         var date_string = moment(userDate, "YYYY-MM-DD").format("MM/DD/YYYY");//"MM-DD-YYYY HH:mm:ss"
            //         this.proteam.updated_at=date_string;
            //     }

          })
          .catch(err => {
            console.log(err);
          });

        $("#empprojectdetailmodal").modal("show");
      },
    },

    mounted() {

      var self = this;

      $("#empProjectTable").on("click", "#projectview", function () {
        self.projectid = $("#projecthiddenid").val();
        self.openprojectdetailpage();
      });
      $("#empProjectTable").on("click", "#empprojectview", function () {
        self.id = $("#empprojecthiddenid").val();
        self.openempprojectdetailpage();
      });

      var token = this.$apitoken;// for api protection api_token is saved globally in app.js and use here
      var baseurldt = this.$baseURLdt;

      // get the id from query parameter to store it in data empid, it is then used in <p>hiddenempid</p>
      // then get the value from the hiddenempid using "var eid=$('#hiddenempid').html();" to use it in datatable parameter
      var eid = this.$route.query.this;
      this.empid = eid;

      $(document).ready(function () {

        // var eid=$('#empprojecthiddenempid').html();
        var eid = self.empid;

        // delay loading of tab data which are not default
        // setTimeout(() => {

        //NO SERVERSIDE PROCESSING
        var table = $('#empProjectTable').DataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bInfo": true,
          "bAutoWidth": true,
          "orderable": false,
          "searchable": false,
          // "width": "100px",
          "pageLength": 10,
          "order": [1, "asc"], // order by ProjectNo                  
          // "serverSide": true,                    
          "processing": true,
          language: {
            // processing: "<img src='/media/icons/ajax-loader.gif'>"
            // processing: "<img src='images/ajax-loader.gif'>",
            processing: "<img src='/img/loading4.gif' style='margin-top:32px;'>",
             "loadingRecords": ""
          },


          "ajax": {
            // "url": "/api/apiempprojectdata/",// passing empid through POST request to api
            // url: baseurldt+"apiempprojectdata", 
            url: self.$host + "api/empprojects/" + eid,
            headers: {
              // Laravel token based api authentication this is retrieved from users/api_token field and added "Bearer " space after
              // for api protection api_token is saved globally in app.js and use here
              'Authorization': token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
            },
            "type": "get",
            "datatype": "json",
            "dataSrc": '', // dont use for server side processing

            // passing empid through GET request to api    
            "data": {
              "EmpID": eid

            },
          },

          "columns": [
            { "data": "ProjectID", "visible": false },
            { "data": "ProjectNo", "mRender": function (data, type, row) {
                // return "<a onclick=$('#projecthiddenid').val("+row.ProjectID +");$('#projecthiddenopendetailpage').click(); style='cursor:pointer;'>"+ data +"</a>";  
                return "<a onclick=$('#projecthiddenid').val(" + row.ProjectID + "); id='projectview' style='cursor:pointer;'>" + data + "</a>";
              }
            },
            // to limit the string. https://stackoverflow.com/questions/31809932/datatable-cell-string-truncate
            { "data": "ProjectName", "mRender": function (data) {
                // { "data": "ProjectName","mRender": function(data, type, row) {
                // if(data.length > 70){
                //     var trimmedString = data.substring(0, 70);
                //     // trimmedString + '...';
                //   return   "<a onclick=$('#projecthiddenid').val("+row.ProjectID +");$('#projecthiddenopendetailpage').click(); style='cursor:pointer;'>"+ trimmedString + '...' +"</a>"
                // } else {
                //     return "<a onclick=$('#projecthiddenid').val("+row.ProjectID +");$('#projecthiddenopendetailpage').click(); style='cursor:pointer;'>"+ data +"</a>";
                //  }
                if (data.length > 60) {
                  var trimmedString = data.substring(0, 60);
                  return trimmedString + '...';
                } else {
                  return data;
                }
              }
            },
            // {"data": "ProjectID", "render": function (data, type, row) {
            // return (
            //     "<a onclick=$('#reghiddenid').val("+row.ID +");$('#reghiddenopendetailpage').click(); style='cursor:pointer'>"+ data +"</a>"
            //     );
            //    }
            // }, 
            {"data": "disEmpProjectRole", "mRender": function (data) {
                if (data.length > 70) {
                  var trimmedString = data.substring(0, 70);
                  return trimmedString + '...';
                } else {
                  return data;
                }
              }
            },
            { "data": "disSecProjectRole", "visible": false, "mRender": function (data) {
                if (data.length > 70) {
                  var trimmedString = data.substring(0, 70);
                  return trimmedString + '...';
                } else {
                  return data;
                }
              }
            },
            { "data": "DutiesAndResponsibilities", "visible": false },
            // https://datatables.net/plug-ins/dataRender/datetime
            // https://datatables.net/forums/discussion/25196/render-date-and-retain-order-functionality-ajax-object
            {"data": "DurationFrom", "render": function (data, type, row) {
                if (data == null) { // to replace "Invalid Date" with "", happens when date field is NULL
                  return "";
                }
                if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                  return "";
                }
                else {
                  return (self.$moment(data).format("MM/DD/YYYY"));
                }
              }
            },
            {"data": "DurationTo", "render": function (data, type, row) {
                if (data == null) { // to replace "Invalid Date" with "", happens when date field is NULL
                  return "";
                }
                if (data == '1900-01-01 00:00:00') { // to replace "default Date"(put by html5 datepicker) with ""
                  return "";
                }
                else {
                  return (self.$moment(data).format("MM/DD/YYYY"));
                }
              }
            },
            { "data": "MonthsOfExp","className":"dt-center" },
            { "data": "Notes", "visible": false },
            { "data": "EmpID", "visible": false },
            { "data": "ID", "render": function (data, type, row) {
                // ** with inline jquery no need to call function from outside vue(masterpage)
                return (
                  "<a onclick=$('#empprojecthiddenid').val(" + row.ID + ");  id='empprojectview' style='cursor:pointer'>View</a>"
                );
              },
            } // end col ID


          ] // end columns


        });//end var table

        // }, 2000) 

      }) // End document ready


    }, // end mounted



  };


</script>



<style>
  #details dt {
    /* font-family: "Roboto", Arial, Helvetica, sans-serif; */
    font-family: "Helvetica", Arial, sans-serif;
    font-size: 13px !important;
    /* letter-spacing: -0.2px; */
    /* margin-right:-40px; */
    text-align: left;
    /* letter-spacing: -.3px; */
    /* letter-spacing: 0.1px; */
    color: #161616;

  }

  /*to align thead dt labels left*/
  .dl-horizontal dt {
    text-align: left;

  }

  dd,
  dt {
    font-family: "Helvetica", Arial, sans-serif;
    /* line-height: 1.72857143; */
    line-height: 1.95;
    /* font-family: "Roboto", Arial, Helvetica, sans-serif; */
    font-size: 13px;
  }

  /* not working in common css so put in the component */
  /* class for processing img, to remove the box around the image */
  .dataTables_processing {
    position: absolute;
    border: none;
    background: transparent;
  }

  #empprojectdetailmodal dt,
  #empprojectdetailmodal dd {
    font-family: "Helvetica", Arial, sans-serif;
    /* line-height: 1.72857143; */
    line-height: 2.0;
    /* font-family: "Roboto", Arial, Helvetica, sans-serif; */
    font-size: 13px;

  }
</style>