<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Alumni Data.xls");
?>

<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<head>
	<style>
		td	{
			text-align: left;
		}
		.center td {
			text-align: center;
		}
	</style>
</head>
<body>
	<table border="1">
		<tr class="center">
			<td></td>
			<td colspan="9">PERSONAL INFO</td>
			<td colspan="5">EDUCATIONAL BACKGROUND</td>
			<td colspan="3">OTHER DEGREES FINISHED</td>
			<td colspan="11">EMPLOYMENT HISTORY</td>
			<td></td>
			<td></td>
		</tr>
		<tr class="center">
			<td>#</td>
			<td>LAST NAME</td>
			<td>FIRST NAME</td>
			<td>GENDER</td>
			<td>PRESENT ADDRESS</td>
			<td>COUNTRY</td>
			<td>PRESENT CONTACT NUMBER</td>
			<td>PERMANENT ADDRESS</td>
			<td>PERMANENT CONTACT NUMBER</td>
			<td>EMAIL</td>

			<td>STUDENT NUMBER</td>
			<td>PROGRAM</td>
			<td>AY GRADUATED</td>
			<td>SEMESTER GRADUATED</td>
			<td>HONOR RECEIVED</td>

			<td>DEGREE</td>
			<td>SCHOOL TAKEN</td>
			<td>YEAR FINISHED</td>

			<td>CURRENT JOB</td>
			<td>FIRST JOB</td>
			<td>SELF EMPLOYED</td>
			<td>BUSINESS</td>
			<td>EMPLOYER</td>
			<td>JOB TYPE</td>
			<td>JOB TITLE</td>
			<td>MONTHLY SALARY</td>
			<td>DURATION</td>
			<td>JOB SATISFACTION</td>
			<td>REASON</td>

			<td>DATE CREATED</td>
			<td>CLEANED</td>
		</tr>

		<?php $count = 0;  ?>
		<?php foreach ($alumni as $var) : ?>
			<tr class="non-center" valign="top">
				<?php $rows = (count($jobs[$count]) >= count($otherDegrees[$count])) ? count($jobs[$count]) : count($otherDegrees[$count]) ; ?>
				<td rowspan="<?= $rows ?>"><?= ($count+1) ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->lastname ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->firstname ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->gender ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->present_address ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->country ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->present_contact_number ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->premanent_address ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->permanent_contact_number ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->email ?></td>

				<td rowspan="<?= $rows ?>"><?= $var->student_number ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->program ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->year_graduated ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->semester_graduated ?></td>
				<td rowspan="<?= $rows ?>"><?= $var->honor_received ?></td>

				<?php $degree = $otherDegrees[$count]; ?>
				<?php if (isset($degree[0])) : ?>
					<td><?= $degree[0]->degree; ?></td>
					<td><?= $degree[0]->school_taken; ?></td>
					<td><?= $degree[0]->year_finished; ?></td>
				<?php else : ?>
					<td></td>
					<td></td>
					<td></td>
				<?php endif; ?>

				<?php $job = $jobs[$count][0]; ?>
				<td><?= ($job->current_job == '1') ? 'yes': 'no'; ?></td>
				<td><?= ($job->first_job == '1') ? 'yes': 'no'; ?></td>
				<td><?= ($job->self_employed == '1') ? 'yes': 'no'; ?></td>
				<td><?= $job->business ?></td>
				<td><?= $job->employer ?></td>
				<td><?= $job->employer_type ?></td>
				<td><?= $job->job_title ?></td>
				<td>
				<?php if ($job->minimum == NULL) : ?>
					<?= $job->maximum.' and below' ?>
				<?php elseif ($job->maximum == NULL) : ?>
					<?= $job->minimum.' and above' ?>
				<?php else: ?>
					<?= $job->minimum.' - '.$job->maximum ?>
				<?php endif; ?>
				</td>
				<?php $year_ended = ($job->year_ended == '100000') ? 'ongoing' : $job->year_ended; ?>
				<td><?= $job->year_started.' - '.$year_ended ?></td>
				<td><?= $job->job_satisfaction ?></td>
				<td><?= $job->reason ?></td>

				<td rowspan="<?= $rows ?>"><?= date('F j, Y', strtotime($var->created_at)) ?></td>
				<td rowspan="<?= $rows ?>"><?= ($var->cleaned == '1') ? 'yes':'no' ?></td>

			</tr>

			<?php for ($i=1; $i < $rows; $i++) : ?>
				<tr>

				<?php $degree = $otherDegrees[$count]; ?>
				<?php if (isset($degree[$i])) : ?>
					<td><?= $degree[$i]->degree; ?></td>
					<td><?= $degree[$i]->school_taken; ?></td>
					<td><?= $degree[$i]->year_finished; ?></td>
				<?php else : ?>
					<td></td>
					<td></td>
					<td></td>
				<?php endif; ?>

				<?php if (isset($jobs[$count][$i])) : ?>
					<?php $job = $jobs[$count][$i]; ?>
				
					<td><?= ($job->current_job == '1') ? 'yes': 'no'; ?></td>
					<td><?= ($job->first_job == '1') ? 'yes': 'no'; ?></td>
					<td><?= ($job->self_employed == '1') ? 'yes': 'no'; ?></td>
					<td><?= $job->business ?></td>
					<td><?= $job->employer ?></td>
					<td><?= $job->employer_type ?></td>
					<td><?= $job->job_title ?></td>
					<td>
					<?php if ($job->minimum == NULL) : ?>
						<?= $job->maximum.' and below' ?>
					<?php elseif ($job->maximum == NULL) : ?>
						<?= $job->minimum.' and above' ?>
					<?php else: ?>
						<?= $job->minimum.' - '.$job->maximum ?>
					<?php endif; ?>
					</td>
					<?php $year_ended = ($job->year_ended == '100000') ? 'ongoing' : $job->year_ended; ?>
					<td><?= $job->year_started.' - '.$year_ended ?></td>
					<td><?= $job->job_satisfaction; ?></td>
					<td><?= $job->reason ?></td>
				
				<?php else : ?>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<?php endif; ?>

				</tr>
			<?php endfor; ?>
			
			<?php $count++; ?>
		<?php endforeach; ?>

	</table>
</body>
</html>
