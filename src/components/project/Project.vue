<template>
  <div>
    <button type="button" v-on:click="showprocolselectormodal" class="btn btn-default pull-right btn-sm"
      style="margin-top:-3px;"><span class="glyphicon glyphicon-cog"></span> Settings </button>
    <h2 style="margin-top: 10px; margin-bottom: 5px; font-size:25px;">Project List</h2>

    <div style="border: 1px solid #3c8dbc;">

      <!-- Extra div for Styling Table Div -->
      <div class="table-body" style="padding:7px;  z-index:100;">


        <!-- <img alt="Vue logo" src="./assets/logo.png" /> -->
        <procolselector v-bind:colsel="fields" />
        <!-- <proeditmodal v-bind:todo="employee" /> -->
        <!-- <proeditmodal v-if="parentloaded" /> -->
        <!--ref="editmodalcomponent" is used to call modal method from parent /> -->
        <proeditmodal ref="editmodalcomponent" v-bind:projectid="projectid" />
        <!-- <globalunauthorisedmsg /> -->

        <input type="text" id="prohiddenid" hidden />

        <a type="button" class="btn btn-default pull-right btn-sm "
          style="margin-left:4px;margin-bottom:10px;color:#006fae;" v-on:click="showproaddmodal"> <span
            aria-hidden="true" class="glyphicon glyphicon-plus" style="color:#006fae"></span> Add new</a>
        <a style="margin-left:4px;" type="button" id="reset" class="btn btn-default pull-right btn-sm"><span
            aria-hidden="true" class="glyphicon glyphicon-refresh"></span> Reset</a>


        <table id="projectTable" class="table table-striped table-bordered" style="width:100%; ">
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
              <th>Status</th>
              <th>ProposalID</th>
              <th style="width:130px;">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</template>



<script>
  import procolselector from "./ProColSelector.vue";
  import proeditmodal from "./ProEditModal.vue";

  export default {
    name: "project",
    components: {
      procolselector,
      proeditmodal
    },
    data() {
      return {
        // editformcomboloaded: false,
        projectid: 0,
        count: 0, //test
        employees: [],
        employee: {
          id: 0,
          email: "rrrr",
          title: "rrrr"
        },
        fields: [
          {
            name: "id",
            visible: true
          }
        ],
        //   lstPrefix: [],
        //   lstSuffix: [],
        //   lstJobTitle: [],
        //   lstDepartment: [],
        //   lstRegistration: [],
        //   lstDisciplineSF330: [],
        //   lstDisciplineSF254: [],
        //   lstEmployeeStatus: [],
        //   lstComID: [],

        image: "", //'/images/employee/AlthaverDB.jpg',
        test: false,
        offset: 4,
        formErrors: {},
        formErrorsUpdate: {},
        user: "", // to get username used to get role for view/edit permission
        testview: false
      };
    },

    methods: {
      showproeditmodal() {

        var s1 = 'admin'; //Blocked for test//this.$usertype;
        var s2="admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
           alert("You don't have permission to run this operation");
          //$("#globalunauthorisedmsg").modal("show");
          return;
        } 


        // to load modal combo only when edit button is clicked, to load after parent is loaded and not to repeat combo loading
        // if (this.editformcomboloaded == false) {
        //   this.$refs.editmodalcomponent.loadcombo();
        //   this.editformcomboloaded = true;
        // }

        // this.projectid = $("#prohiddenid").val();  // this.projectid now set in mounted under table click

        this.$refs.editmodalcomponent.loadeditdata(this.projectid);

        $("#proeditmodal").modal("show");

      },



      showproaddmodal() {

        var s1 = 'admin'; //Blocked for test//this.$usertype;
        var s2="admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
           alert("You don't have permission to run this operation");
          //$("#globalunauthorisedmsg").modal("show");
          return;
        } 


        $('#proform').trigger("reset");
        // $('#empform')[0].reset();
        this.$refs.editmodalcomponent.clearaddform();
        $("#proeditmodal").modal("show");

      },


      openprodetailpage() {

        // this.projectid = $("#prohiddenid").val();  // this.projectid now set in mounted under table click

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


      deletepro() {

        var s1 = 'admin'; //Blocked for test//this.$usertype;
        var s2 = "admin";
        if (s1.trim() !== s2.trim()) { // trim should be used for js string compare for any white space
           alert("You don't have permission to run this operation");
          //$("#globalunauthorisedmsg").modal("show");
          return;
        }


        var confirmdelete = confirm("Are you you want to delete the item?");
        if (confirmdelete == false) {
          return;
        }

        // this.projectid = $("#prohiddenid").val(); // this.projectid now set in mounted under table click

        this.$axios
          .post("apiprodeletedata/" + this.projectid + "").then(response => {
            // this.formdata = response.data[0];
            $('#projectTable').DataTable().ajax.reload(); // refresh parent table
          })
          .catch(err => {
          iziToast.error({
              title: 'Error',
              message: 'Error deleting project',
            });
          });
      },


      showprocolselectormodal() {
        $("#procolselectormodal").modal("show");
      },

    },

    mounted() {

      var token = this.$apitoken;// for api protection api_token is saved globally in app.js and use here
      var baseurldt = this.$baseURLdt;
      var self = this;

      $("#projectTable").on("click", "#proview", function () {
        self.projectid = $("#prohiddenid").val();
        self.openprodetailpage();
      });
      $("#projectTable").on("click", "#proedit", function () {
        self.projectid = $("#prohiddenid").val();
        self.showproeditmodal();
      });
      $("#projectTable").on("click", "#prodelete", function () {
        self.projectid = $("#prohiddenid").val();
        self.deletepro();
      });


      $(document).ready(function () {
        //alert(XSRF-Token.val());
        $("#projectTable").DataTable({
          processing: true, // make it false, sometimes for this table gives ajax error on load
          serverSide: true,
          "order": [[1, "asc"]],// order by ProjectNo
          "lengthMenu": [[15, 25, 50, 100, -1], [15, 25, 50, 100, "All"]],
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
            // url: "/api/apiprojectdata",
            // url: baseurldt+"apiprojectdata",
            url: self.$host + "api/project",
            //url:"http://kseng.com/laravelroot2/Employee/testposts/",
            //url:"/datatable/getposts",

            //https://laravel.io/forum/04-10-2017-laravel-datatable-and-tokenmismatchexception-in-verifycsrftokenphp-line-68
            headers: {
              // "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              'Authorization': token //'Bearer $2y$10$0x8otLt/af.wDPiogAYG.OPEHaw4YR6/UYzNIHao8X0CjqATOrbv2'
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
            data: function (d) {
              d.jobtitle = 5;
              // d.jobtitle = $('#jobtitle').val();
              // d.department = $('#department').val();
              // d.registration = $('#registration').val();
              // d.disciplinesf254 = $('#disciplinesf254').val();
              // d.disciplinesf330 = $('#disciplinesf330').val();
              // d.empdegree = $('#empdegree').val();
              // d.projecttype = $('#projecttype').val();
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
              render: function (data, type, row) {
                // return ( "<a  onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddenopendetailpage').click(); style='cursor:pointer'>"+data +"</a>")
                return ("<a  onclick=$('#prohiddenid').val(" + row.ProjectID + "); id='proview' style='cursor:pointer'>" + data + "</a>")
              }
            },
            {
              "data": "ProjectName", "mRender": function (data, type, row) {
                if (data.length > 35) {
                  var trimmedString = data.substring(0, 35);
                  return trimmedString + '...';
                } else {
                  return data;
                }
              }
            },
            {
              data: "disProjectRole",
              // visible: false
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
            {
              "data": "disPrimaryProjectType", "defaultContent": "", "mRender": function (data, type, row) {
                if (data.length > 20) {
                  var trimmedString = data.substring(0, 20);
                  return trimmedString + '...';
                } else {
                  return data;
                }
              }
            },
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
            {
              "data": "disOwner", "mRender": function (data, type, row) {
                if (data.length > 22) {
                  var trimmedString = data.substring(0, 22);
                  return trimmedString + '...';
                } else {
                  return data;
                }
              }
            },
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
              visible: false
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
              render: function (data, type, row) {
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
                  // "<a onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddenopendetailpage').click(); style='cursor:pointer'>View</a> | <a onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddenshoweditmodal').click(); style='cursor:pointer'>Edit</a> | <a onclick=$('#prohiddenid').val("+row.ProjectID +");$('#hiddendeleteemp').click(); style='cursor:pointer'>Delete</a>"

                  "<a onclick=$('#prohiddenid').val(" + row.ProjectID + "); id='proview' style='cursor:pointer'>View</a> | <a onclick=$('#prohiddenid').val(" + row.ProjectID + "); id='proedit' style='cursor:pointer'>Edit</a> | <a onclick=$('#prohiddenid').val(" + row.ProjectID + ");id='prodelete' style='cursor:pointer'>Delete</a>"
                  // "<a onclick=$('#prohiddenid').val("+row.ProjectID +"); id='proview' style='cursor:pointer'>View</a>"

                );
              }
            }
          ]

          // order: [[1, "asc"]] // used for default sort col
        });

        // ColSelector method
        // $(document).ready(function() {
        // Column visibility
        $("input.vis").on("click", function (e) {
          //e.preventDefault(); checkbox will not chk with this line
          var table = $("#projectTable").DataTable();
          // Get the column API object
          var column = table.column($(this).attr("data-column"));
          // Toggle the visibility
          column.visible(!column.visible());
        });

        $('#reset').on('click', function () {
          // $('#empSearchForm')[0].reset();
          var table = $('#projectTable').DataTable();
          table.search('').columns().search('').draw();//clear datatable search filter
          table.ajax.reload();
          (this).blur();// to move focus from btn
        });


        // Following code can be used to hide action column as per user role
        // var table = $("#projectTable").DataTable();
        // var column = table.column(1);
        // column.visible(!column.visible());

        // });

      }); // document

      this.user = $("#username").html();// to get username used to get role

    }, // created

  }; // export default

</script>




<style>
  /* not working in common css so put in one of the component */
  /* class for processing img, to remove the box around the image */
  .dataTables_processing {
    position: absolute;
    border: none;
    background: transparent;
  }

  /* styling for Export button styling */
  #projectTable_filter {
    /* float:left;
  margin-left:741px; */
  }

  #projectTable_length {
    float: left;
    margin-left: 10px;
  }

  #projectTable_filter>label,
  #projectTable_length>label {
    margin-bottom: 0px;
  }

  /* Export button styling */
  button.dt-button,
  div.dt-button,
  a.dt-button {
    position: relative;
    /* position: absolute; */
    display: inline-block;
    box-sizing: border-box;
    margin-right: 0.333em;
    margin-bottom: 0.333em;
    padding: 0.5em 1em;
    /* border: 1px solid #999; */
    border: 1px solid #bebebe;
    border-radius: 3px;
    cursor: pointer;
    font-size: 0.88em;
    line-height: 1.6em;
    /* color: black; */
    color: #555555;
    white-space: nowrap;
    overflow: hidden;
    background-color: #e9e9e9;
    padding: 5px;
    padding-left: 6px;
    padding-right: 6px;
    /* border: none; */
    background: transparent;
  }

  .dataTables_info {
    float: left;
  }
</style>