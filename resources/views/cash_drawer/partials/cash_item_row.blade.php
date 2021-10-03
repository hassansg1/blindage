<tr id="tableRowCash">
    <td>$1.00</td>
    <td><input style="width: 50%" type="number" value="{{isset($data)?$data->cash_one:0}}" name="{{isset($data)?$data->cash_one:'cash_one'}}" id="cashOne" onchange="setTotal('1','cashOne','b')" class="form-control"></td>
    <td><span>$</span> <span id="cashOneTotal">{{floatval(isset($data)?$data->cash_one:0) * 1}}</span></td>
    <td>$0.01</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->coin_point_z_one:'coin_point_z_one'}}" value="{{isset($data)?$data->coin_point_z_one:0}}" id="pointZOne"  onchange="setTotal('0.01','pointZOne','c')" class="form-control"></td>
    <td><span>$</span> <span id="pointZOneTotal">{{floatval(isset($data)?$data->coin_point_z_one:0) * .01}}</span></td>
</tr>
<tr id="tableRowCash">
    <td>$5.00</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->cash_five:'cash_five'}}" value="{{isset($data)?$data->cash_five:0}}" id="cashFive" onchange="setTotal('5','cashFive','b')"  class="form-control"></td>
    <td><span>$</span> <span id="cashFiveTotal">{{floatval(isset($data)?$data->cash_five:0) * 5}}</span></td>
    <td>$0.05</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->coin_point_z_five:'coin_point_z_five'}}" value="{{isset($data)?$data->coin_point_z_five:0}}" id="pointZFive" onchange="setTotal('.05','pointZFive','c')"  class="form-control"></td>
    <td><span>$</span> <span id="pointZFiveTotal">{{floatval(isset($data)?$data->coin_point_z_five:0) * .05}}</span></td>
</tr>
<tr id="tableRowCash">
    <td>$10.00</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->cash_ten:'cash_ten'}}" value="{{isset($data)?$data->cash_ten:0}}" id="cashTen" onchange="setTotal('10','cashTen','b')" class="form-control"></td>
    <td><span>$</span> <span id="cashTenTotal">{{floatval(isset($data)?$data->cash_ten:0) * 10}}</span></td>
    <td>$0.10</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->coin_point_one:'coin_point_one'}}" value="{{isset($data)?$data->coin_point_one:0}}" id="pointOne"  onchange="setTotal('.1','pointOne','c')"  class="form-control"></td>
    <td><span>$</span> <span id="pointOneTotal">{{floatval(isset($data)?$data->coin_point_one:0) * .1}}</span></td>
</tr>
<tr id="tableRowCash">
    <td>$20.00</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->cash_twenty:'cash_twenty'}}"  value="{{isset($data)?$data->cash_twenty:0}}" id="cashTwenty"  onchange="setTotal('20','cashTwenty','b')"  class="form-control"></td>
    <td><span>$</span> <span id="cashTwentyTotal">{{floatval(isset($data)?$data->cash_twenty:0) * 20}}</span></td>
    <td>$0.25</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->coin_point_two_five:'coin_point_two_five'}}" value="{{isset($data)?$data->coin_point_two_five:0}}"  id="pointTwoFive"  onchange="setTotal('.25','pointTwoFive','c')"  class="form-control"></td>
    <td><span>$</span> <span id="pointTwoFiveTotal">{{floatval(isset($data)?$data->coin_point_two_five:0) * .25}}</span></td>
</tr>
<tr id="tableRowCash">
    <td>$50.0</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->cash_fifty:'cash_fifty'}}" value="{{isset($data)?$data->cash_fifty:0}}" id="cashFifty"  onchange="setTotal('50','cashFifty','b')"  class="form-control"></td>
    <td><span>$</span> <span id="cashFiftyTotal">{{floatval(isset($data)?$data->cash_fifty:0) * 50}}</span></td>
    <td>$0.50</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->coin_point_five:'coin_point_five'}}" value="{{isset($data)?$data->coin_point_five:0}}" id="pointFive"  onchange="setTotal('.5','pointFive','c')"  class="form-control"></td>
    <td><span>$</span> <span id="pointFiveTotal">{{floatval(isset($data)?$data->coin_point_five:0) * .5}}</span></td>
</tr>
<tr id="tableRowCash">
    <td>$100</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->cash_hundred:'cash_hundred'}}" value="{{isset($data)?$data->cash_hundred:0}}" id="cashHundred" onchange="setTotal('100','cashHundred','b')"  class="form-control"></td>
    <td><span>$</span> <span id="cashHundredTotal">{{floatval(isset($data)?$data->cash_hundred:0) * 100}}</span></td>
    <td>$1.00</td>
    <td><input style="width: 50%" type="number" name="{{isset($data)?$data->coin_one:'coin_one'}}" value="{{isset($data)?$data->coin_one:0}}" id="coinOne"   onchange="setTotal('1','coinOne','c')" class="form-control"></td>
    <td><span>$</span> <span id="coinOneTotal">{{floatval(isset($data)?$data->coin_one:0) * 1}} </span></td>
</tr>
<tr id="tableRowCash">
    <td>Bills Total</td>
    <td></td>
    <td><span>$</span> <input id="billsTotal" name="{{isset($data)?$data->total_coins:'total_cash'}}" value="{{floatval(isset($data)?$data->total_cash:0)}}"  readonly style="border: none"></td>
    <td>Coins Total</td>
    <td></td>
    <td><span>$</span> <input id="coinsTotal" name="{{isset($data)?$data->total_coins:'total_coins'}}" value="{{floatval(isset($data)?$data->total_coins:0)}}"  readonly style="border: none"></td>
</tr>
<tr >
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>
        <h4>Counted Cash Total</h4></td>
    <td>$<input readonly style="border: none" id="grandTotal"  value="{{floatval(isset($data)?$data->cashDrawer->total_amount:0)}}" name="total_amount"></td>
</tr>
