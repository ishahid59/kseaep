<template>

<!-- columnSelectorModalModal ==================================================-->
<!-- Trigger the modal with a button -->
<div id="empcolselectormodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="font-weight:bold">Show/Hide Columns</h3>
            </div>

   

            <div class="modal-body">

         <div class="form-group">
                <div class="panel panel-default">
                  <!-- <div class="panel-heading">
                    <h4 class="panel-title" style="color:black">Visible fields</h4>
                  </div> -->
               <div class="panel-body" style="color:black">


                <p style="line-height:0.5">
                    <!-- clickable checkbox label -->
                    <!-- <label for="id" style="cursor:pointer;font-weight: normal" ><input class="vis" data-column="0" type="checkbox" id="id"  value="value" style="cursor:pointer"/> Id </label> -->
                    <input class="vis" data-column="0" type="checkbox" id="id" style="cursor:pointer" >
                    <label for="id" style="cursor:pointer;font-weight: normal; margin-left:5px ">Id</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="1" type="checkbox" id="employeeid" style="cursor:pointer" checked />
                    <label for="employeeid" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Employee Id</label>
                </p>

                <p style="line-height:0.5">
                    <input class="vis" data-column="2" type="checkbox" id="firstname" style="cursor:pointer" checked />
                    <label for="firstname" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">First Name</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="3" type="checkbox" id="lastname" style="cursor:pointer" />
                    <label for="lastname" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Last Name</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="4" type="checkbox" id="comid" style="cursor:pointer" />
                    <label for="comid" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer "> Company</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="5" type="checkbox" id="jobtitle" style="cursor:pointer" checked />
                    <label for="jobtitle" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer "> Job Title</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="6" type="checkbox" id="department" style="cursor:pointer" checked />
                    <label for="department" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer "> Department</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="7" type="checkbox" id="registration" style="cursor:pointer" checked />
                    <label for="registration" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer "> Registration</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="8" type="checkbox" id="hiredate" style="cursor:pointer" checked />
                    <label for="hiredate" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer "> Hire Date</label>
                </p>

                <p style="line-height:0.5;"> 
                        <input class="vis" data-column="9" type="checkbox" id="discipline254" style="cursor:pointer"   />
                        <label for="discipline254" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer "> Discipline SF254</label>
                    </p>

                    <p style="line-height:0.5;">
                        <input class="vis" data-column="10" type="checkbox" id="discipline330" style="cursor:pointer" />
                        <label for="discipline330" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Discipline SF330</label>
                    </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="11" type="checkbox" id="employeestatus" style="cursor:pointer" checked/>
                    <label for="employeestatus" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Employee Status</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="12" type="checkbox" id="expwithotherfirm" style="cursor:pointer" />
                    <label for="expwithotherfirm" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Exp. with other firm</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="13" type="checkbox" id="employee_consultant" style="cursor:pointer" />
                    <label for="employee_consultant" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Action</label>
                </p>

                <!-- <p style="line-height:0.5;">
                    <input class="vis" data-column="14" type="checkbox" id="action" style="cursor:pointer" checked />
                    <label for="action" style="cursor:pointer;font-weight: normal; margin-left:5px ">Action</label>
                </p> -->


                  </div>
                </div>
             </div>





            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>
<!-- End columnSelectorModalModal ==================================================-->

</template>

<script>

export default {
  name: "empcolselector",
  data() {
    return {
      count: 0,

    };
  },
  props:[
      "colsel"
  ]

}


</script>



<style >

</style>