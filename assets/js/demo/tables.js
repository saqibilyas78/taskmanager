/*
 * general_ui.js
 *
 * Demo JavaScript used on General UI-page.
 */

"use strict";

$(document).ready(function () {


	// ------------------------------------------------------------------------------------------------
	// ------------------------------------ Task Manger -------------------------------------

	// **##**##**##**##**##**##**##**##**##**## Prjects   **##**##**##**##**##**##**##**##**##**##**##

	// Project Datatable
	$(".datatable-project").dataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "gridmodel/project_grid.php",
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': [0, 5] }
		],
		"aoColumns": [
			null,
			null,
			null,
			null,
			null,
			{
				"mData": null,
				"sDefaultContent": "Action"
			}
		],
		"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			// Bold the grade for all 'A' grade browsers
			$('td:eq(0)', nRow).html(iDisplayIndex + 1);
			//
			$('td:eq(5)', nRow).html('<span class="btn-group"><a href="javascript:void(0);" value="' + aData[0] + '" title="Edit Project" class="btn btn-s bs-tooltip btn-project-edit"><i class="icon-edit"></i></a><a href="javascript:void(0);" value="' + aData[0] + '" title="Delete Project" class="btn btn-s bs-tooltip btn-delete-project"><i class="icon-trash"></i></a></span>');
		}
	});


	// ***************************************  Update Status project  ****************************************
	$(document).on('click', '.project_status_disable_enable', function () {
		var v = $(this).find('a').attr('value');
		var i = $(this).find('a').attr('row');
		var countTableRow = $(this).find('a').attr('countTableRow');

		$.ajax(
			{
				url: "ajax_data/update_action.php",
				type: "POST",
				data: { id: i, value: v, tableRow: countTableRow, action: 'btn-project-update' },
				success: function (data, textStatus, jqXHR) {
					var item1 = $(".project_taskStatus" + countTableRow);
					$(item1).html(data);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//if fails     
				}
			});

	});

	// *************************************** END Update Status project  ****************************************

	// ***************************************  Edit project  ****************************************

	$("#project-edit").dialog({
		autoOpen: false,
		title: "Edit Project",
		modal: true,
		width: "700",
		buttons: [{
			text: "Update",
			click: function () {
				$(this).find('form#validate-3').submit();
			}
		}, {
			text: "Close",
			click: function () {
				$(this).dialog("close");
			}
		}]
	});

	$(document).on('click', '.btn-project-edit', function () {
		var value = $(this).attr('value');
		$.ajax(
			{
				url: "ajax_data/edit_project.php",
				type: "POST",
				data: { id: value },
				success: function (data, textStatus, jqXHR) {
					$('.mws-dialog-inner-project-edit').html(data);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//if fails     
				}
			});

		$("#project-edit").dialog("option", {
			modal: false
		}).dialog("open");
		//event.preventDefault();
	});

	//  ******************************************* END Edit project ***********************************************

	// ***************************************  Delete project  ****************************************
	$(document).on('click', '.btn-delete-project', function () {
		var value = $(this).attr('value');
		$('.mws-dialog-inner-project-delete').css('display', 'block');

		$("#project-delete").dialog({
			autoOpen: false,
			title: "Delete Project",
			modal: true,
			width: "600",
			buttons: [{
				text: "Delete",
				click: function () {
					$.ajax(
						{
							url: "ajax_data/delete_action.php",
							type: "POST",
							data: { id: value, action: 'btn-project-delete' },
							success: function (data, textStatus, jqXHR) {
								window.location = 'manage_projects.php';
							},
							error: function (jqXHR, textStatus, errorThrown) {
								//if fails     
							}
						});
					$('.mws-dialog-inner-project-delete').css('display', 'none');
					$(this).dialog("close");
				}
			}, {
				text: "Cancel",
				click: function () {
					$('.mws-dialog-inner-project-delete').css('display', 'none');
					$(this).dialog("close");
				}
			}]

		}).dialog("open");


	});

	// ***************************************  END Delete project  ****************************************

	// ***************************************  Start task  ****************************************
	// Task Datatable
	$(".datatable-task").dataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "gridmodel/task_grid.php",
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': [0, 5] }
		],
		"aoColumns": [
			null,
			null,
			null,
			null,
			null,
			{
				"mData": null,
				"sDefaultContent": "Action"
			}
		],
		"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			// Bold the grade for all 'A' grade browsers
			$('td:eq(0)', nRow).html(iDisplayIndex + 1);
			//
			$('td:eq(5)', nRow).html('<span class="btn-group"><a href="javascript:void(0);" value="' + aData[0] + '" title="Edit Task" class="btn btn-s bs-tooltip btn-task-edit"><i class="icon-edit"></i></a><a href="javascript:void(0);" value="' + aData[0] + '" title="Delete Task" class="btn btn-s bs-tooltip btn-delete-task"><i class="icon-trash"></i></a></span>');
		}
	});

	// ***************************************  Edit task  ****************************************

	$("#task-edit").dialog({
		autoOpen: false,
		title: "Edit Task",
		modal: true,
		width: "700",
		buttons: [{
			text: "Update",
			click: function () {
				$(this).find('form#validate-3').submit();
			}
		}, {
			text: "Close",
			click: function () {
				$(this).dialog("close");
			}
		}]
	});

	$(document).on('click', '.btn-task-edit', function () {
		var value = $(this).attr('value');
		$.ajax(
			{
				url: "ajax_data/edit_task.php",
				type: "POST",
				data: { id: value },
				success: function (data, textStatus, jqXHR) {
					$('.mws-dialog-inner-task-edit').html(data);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//if fails     
				}
			});

		$("#task-edit").dialog("option", {
			modal: false
		}).dialog("open");
		//event.preventDefault();
	});

	//  ******************************************* END Edit task ***********************************************

	// ***************************************  Delete task  ****************************************
	$(document).on('click', '.btn-delete-task', function () {
		var value = $(this).attr('value');
		$('.mws-dialog-inner-task-delete').css('display', 'block');

		$("#task-delete").dialog({
			autoOpen: false,
			title: "Delete Task",
			modal: true,
			width: "600",
			buttons: [{
				text: "Delete",
				click: function () {
					$.ajax(
						{
							url: "ajax_data/delete_action.php",
							type: "POST",
							data: { id: value, action: 'btn-task-delete' },
							success: function (data, textStatus, jqXHR) {
								window.location = 'tasks.php';
							},
							error: function (jqXHR, textStatus, errorThrown) {
								//if fails     
							}
						});
					$('.mws-dialog-inner-task-delete').css('display', 'none');
					$(this).dialog("close");
				}
			}, {
				text: "Cancel",
				click: function () {
					$('.mws-dialog-inner-task-delete').css('display', 'none');
					$(this).dialog("close");
				}
			}]

		}).dialog("open");


	});

	// ***************************************  END Delete task  ****************************************


	// ------------------------------------ END Task Manager -------------------------------------
	// ------------------------------------------------------------------------------------------------   


	$(".ui-dialog-buttonset :button").removeClass("ui-state-default");



	//++==++==++==++==++==++==++==++==      					++==++==++==++==++==++==++==++==
	//++==++==++==++==++==++==++==++==      not related to us	++==++==++==++==++==++==++==++==           
	//++==++==++==++==++==++==++==++==      					++==++==++==++==++==++==++==++==


	//===== Notifications =====//

	// @see: for default options, see assets/js/plugins.js (initNoty())

	$('.btn-notification').click(function () {
		var self = $(this);

		noty({
			text: self.data('text'),
			type: self.data('type'),
			layout: self.data('layout'),
			timeout: 2000,
			modal: self.data('modal'),
			buttons: (self.data('type') != 'confirm') ? false : [
				{
					addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty) {
						$noty.close();
						noty({ force: true, text: 'You clicked "Ok" button', type: 'success', layout: self.data('layout') });
					}
				}, {
					addClass: 'btn btn-danger', text: 'Cancel', onClick: function ($noty) {
						$noty.close();
						noty({ force: true, text: 'You clicked "Cancel" button', type: 'error', layout: self.data('layout') });
					}
				}
			]
		});

		return false;
	});


	//===== Slim Progress Bars (nprogress) =====//
	$('.btn-nprogress-start').click(function () {
		NProgress.start();
		$('#nprogress-info-msg').slideDown(200);
	});

	$('.btn-nprogress-set-40').click(function () {
		NProgress.set(0.4);
	});

	$('.btn-nprogress-inc').click(function () {
		NProgress.inc();
	});

	$('.btn-nprogress-done').click(function () {
		NProgress.done();
		$('#nprogress-info-msg').slideUp(200);
	});

	//===== Bootbox (Modals and Dialogs) =====//
	$("a.basic-alert").click(function (e) {
		e.preventDefault();
		bootbox.alert("Hello world!", function () {
			console.log("Alert Callback");
		});
	});

	$("a.confirm-dialog").click(function (e) {
		e.preventDefault();
		bootbox.confirm("Are you sure?", function (confirmed) {
			console.log("Confirmed: " + confirmed);
		});
	});

	$("a.multiple-buttons").click(function (e) {
		e.preventDefault();
		bootbox.dialog({
			message: "I am a custom dialog",
			title: "Custom title",
			buttons: {
				success: {
					label: "Success!",
					className: "btn-success",
					callback: function () {
						console.log("great success");
					}
				},
				danger: {
					label: "Danger!",
					className: "btn-danger",
					callback: function () {
						console.log("uh oh, look out!");
					}
				},
				main: {
					label: "Click ME!",
					className: "btn-primary",
					callback: function () {
						console.log("Primary button");
					}
				}
			}
		});
	});

	$("a.multiple-dialogs").click(function (e) {
		e.preventDefault();

		bootbox.alert("Prepare for multiboxes in 1 second...");

		setTimeout(function () {
			bootbox.dialog({
				message: "Do you like Melon?",
				title: "Fancy Title",
				buttons: {
					danger: {
						label: "No :-(",
						className: "btn-danger",
						callback: function () {
							bootbox.alert("Aww boo. Click the button below to get rid of all these popups.", function () {
								bootbox.hideAll();
							});
						}
					},
					success: {
						label: "Oh yeah!",
						className: "btn-success",
						callback: function () {
							bootbox.alert("Glad to hear it! Click the button below to get rid of all these popups.", function () {
								bootbox.hideAll();
							});
						}
					}
				}
			});
		}, 1000);
	});

	$("a.programmatic-close").click(function (e) {
		e.preventDefault();
		var box = bootbox.alert("This dialog will automatically close in two seconds...");
		setTimeout(function () {
			box.modal('hide');
		}, 2000);
	});

});

