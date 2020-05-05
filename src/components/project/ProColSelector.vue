<template>

<!-- columnSelectorModalModal ==================================================-->
<!-- Trigger the modal with a button -->
<div id="procolselectormodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Show/Hide Columns</h4>
            </div>

   

            <div class="modal-body">

         <div class="form-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="color:black">Visible fields</h4>
                  </div>
               <div class="panel-body" style="color:black">


                <p style="line-height:0.5">
                    <!-- clickable checkbox label -->
                    <!-- <label for="id" style="cursor:pointer;font-weight: normal" ><input class="vis" data-column="0" type="checkbox" id="id"  value="value" style="cursor:pointer"/> Id </label> -->
                    <input class="vis" data-column="0" type="checkbox" id="ProjectID" style="cursor:pointer" >
                    <label for="ProjectID" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">ProjectID</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="1" type="checkbox" id="ProjectNo" style="cursor:pointer" checked />
                    <label for="ProjectNo" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Project No.</label>
                </p>

                <p style="line-height:0.5">
                    <input class="vis" data-column="2" type="checkbox" id="ProjectName" style="cursor:pointer" checked />
                    <label for="ProjectName" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Project Name</label>
                </p>


                <p style="line-height:0.5;">
                    <input class="vis" data-column="3" type="checkbox" id="ProjectRole" style="cursor:pointer" checked/>
                    <label for="ProjectRole" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Project Role</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="4" type="checkbox" id="AwardYear" style="cursor:pointer" checked/>
                    <label for="AwardYear" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer "> Award Year</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="5" type="checkbox" id="ProjectManager" style="cursor:pointer"  />
                    <label for="ProjectManager" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Project Manager</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="6" type="checkbox" id="OwnerCategory" style="cursor:pointer"  />
                    <label for="OwnerCategory" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Owner Category</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="7" type="checkbox" id="ComID" style="cursor:pointer"  />
                    <label for="ComID" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Company</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="8" type="checkbox" id="PrimaryProjectType" style="cursor:pointer" checked />
                    <label for="PrimaryProjectType" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Primary Project Type</label>
                </p>

                    <p style="line-height:0.5;">
                        <input class="vis" data-column="9" type="checkbox" id="SecondaryProjectType" style="cursor:pointer" />
                        <label for="SecondaryProjectType" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Secondary Project Type</label>
                    </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="10" type="checkbox" id="Owner" style="cursor:pointer" checked/>
                    <label for="Owner" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Owner</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="11" type="checkbox" id="Client" style="cursor:pointer" />
                    <label for="Client" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Client</label>
                </p>

                <p style="line-height:0.5;">
                    <input class="vis" data-column="12" type="checkbox" id="ProjectAgreementNo" style="cursor:pointer" />
                    <label for="ProjectAgreementNo" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Project Agreement No.</label>
                </p>
                <p style="line-height:0.5;">
                    <input class="vis" data-column="13" type="checkbox" id="ProjectStatus" style="cursor:pointer" />
                    <label for="ProjectStatus" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">Project Status</label>
                </p>
                <p style="line-height:0.5;">
                    <input class="vis" data-column="14" type="checkbox" id="ProposalID" style="cursor:pointer" />
                    <label for="ProposalID" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer ">ProposalID</label>
                </p>

                <!-- <p style="line-height:0.5;">
                    <input class="vis" data-column="14" type="checkbox" id="action" style="cursor:pointer" checked />
                    <label for="action" style="cursor:pointer;font-weight: normal; margin-left:5px ">Action</label>
                </p> -->

                <p style="line-height:0.5">
                     <input class="vis" data-column="15" type="checkbox" id="ProID" style="cursor:pointer" >
                    <label for="ProID" style="cursor:pointer;font-weight: normal; margin-left:5px;cursor:pointer"> Action</label>
                </p>


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
  name: "procolselector",
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