<h3>Order summery</h3>
<table class="table ngg_order_detail table-bordered">
    <thead>
        <tr class="table-secondary">
            <th class="ngg-pname" width="30%">Product Name</th>
            <th class="ngg-price" width="10%">Price</th>
            <th class="ngg-desc" width="59%">Description</th>
        </tr>
    </thead>
    <tbody class="ngg_order_summery">
        <tr>
            <td class="ngg-pname">{{ $productInfo->name }}</td>
            <td class="ngg-price">{{ '$'.$productInfo->price }}</td>
            <td class="ngg-price">{{ $productInfo->description }}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right"><b>Total</b></td>
            <td colspan="2"><b>{{ '$'.$productInfo->price }}</b></td>
        </tr>
    </tbody>
</table>
