function clearForm(){$("#x_location").val("");$("#x_su").val("");$("#x_ctn").val("");$("#x_scan").val("");$("#x_article").val("");$("#x_location").attr("disabled",false);$("#x_su").attr("disabled",false);$("#x_ctn").attr("disabled",false);$("#x_location").focus();$("#x_article").val("")}function clearForm2(){$("#x_destination_location").val("");$("#x_su").val("");$("#x_destination_location").attr("readonly",false);$("#x_su").attr("readonly",false);$("#x_destination_location").focus()}function skip2(){$("#x_actual").val("");$("#x_pick_quantity").val("0");$("#x_excess").val("0");$("#btn-action").focus()}function selectAll(){$("#my-select > option").prop("selected",true);$("#my-select").trigger("change")}function deselectAll(){$("#my-select > option").prop("selected",false);$("#my-select").trigger("change")}function close2(){$("#x_close_totes").val("2");$("#btn-action").focus()}