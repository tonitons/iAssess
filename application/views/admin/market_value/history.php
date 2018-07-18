<div class="container">
    <div class="row register-form">
    <div class="custom-form">
    <h2>Revision History</h2>
    <div class="clearfix"></div>
        <div class="bs-example bs-example-tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
              <li class="active aw"><a href="#admin" role="tab" data-toggle="tab"><label for="">AGRICULTURE</label></a></li>
              <li class="aw"><a href="#staff" role="tab" data-toggle="tab"><label for="">LANDS</label></a></li>
              <li class="aw"><a href="#treasurer" role="tab" data-toggle="tab"><label for="">IMPROVEMENTS</label></a></li>
              <li class="aw"><a href="#owner" role="tab" data-toggle="tab"><label for="">BUILDING</label></a></li>
            </ul>
            <br>
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane active fade in" id="admin">
                      <!-- <br><h2>&nbsp;</h2> -->
                        <div class="table-responsive">
                            <table class="table table-bordered" style="background-color:white">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">LANDS</label></th>
                                        <th><label for="">1ST CLASS</label></th>
                                        <th><label for="">2ND CLASS</label></th>
                                        <th><label for="">3RD CLASS</label></th>
                                        <th><label for="">Revision</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($agri_land_hx as $mvalue): ?>
                                    <tr>
                                        <td class="hidden"><?php echo $mvalue->agri_id ?></td>
                                        <td><?php echo $mvalue->agri_land ?></td>
                                        <td><?php echo number_format($mvalue->first, 2) ?></td>
                                        <td><?php echo number_format($mvalue->second, 2) ?></td>
                                        <td><?php echo number_format($mvalue->third, 2) ?></td>
                                        <td><?php echo $mvalue->revision ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="staff">
                        
                        <div class="table-responsive">

                            <table class="table table-bordered" style="background-color:white;">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">KIND</label></th>
                                        <th><label for="">1ST CLASS</label></th>
                                        <th><label for="">2ND CLASS</label></th>
                                        <th><label for="">3RD CLASS</label></th>
                                        <th><label for="">4TH CLASS</label></th>
                                        <th><label for="">5TH CLASS</label></th>
                                        <th><label for="">Revision</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rci_land_hx as $mvalue): ?>
                                    <tr>
                                        <td class="hidden"><?php echo $mvalue->rci_id ?></td>
                                        <td><?php echo $mvalue->kind ?></td>
                                        <td><?php echo number_format($mvalue->first, 2) ?></td>
                                        <td><?php echo number_format($mvalue->second, 2) ?></td>
                                        <td><?php echo number_format($mvalue->third, 2) ?></td>
                                        <td><?php echo number_format($mvalue->fourth, 2) ?></td>
                                        <td><?php echo number_format($mvalue->fifth, 2) ?></td>
                                        <td><?php echo $mvalue->revision ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="treasurer">
                        <div class="table-responsive">

                            <table class="table table-bordered" style="background-color:white">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">KIND</label></th>
                                        <th><label for="">VALUE</label></th>
                                        <th><label for="">Revision</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($improvements_hx as $mvalue): ?>
                                    <tr>
                                        <td><?php echo $mvalue->kind ?></td>
                                        <td><?php echo number_format($mvalue->value, 2) ?></td>
                                        <td><?php echo $mvalue->revision ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="owner">
                        <div class="table-responsive">

                            <table class="table table-bordered" style="background-color:white">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">CLASS</label></th>
                                        <th><label for="">TYPE OF BUILDING</label></th>
                                        <th><label for="">VALUE</label></th>
                                        <th><label for="">Revision</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($building_hx as $mvalue): ?>
                                    <tr>
                                        <td><?php echo $mvalue->building_type ?></td>
                                        <td><?php echo $mvalue->name_building ?></td>
                                        <td><?php echo number_format($mvalue->value, 2) ?></td>
                                        <td><?php echo $mvalue->revision ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        
    <!-- </form> -->
    </div>
</div>
</div>