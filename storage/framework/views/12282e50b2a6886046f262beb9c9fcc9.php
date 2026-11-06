<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-slate-800 tracking-tight">STOK TERSEDIA REALTIME</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pantau jumlah sisa stok barang kebersihan yang tersedia di gudang saat ini</p>
            </div>
            <a href="<?php echo e(route('stok.opname')); ?>" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-xs shadow-sm flex items-center justify-center space-x-2 transition">
                <i class="fa-solid fa-clipboard-check"></i>
                <span>Lakukan Stok Opname</span>
            </a>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <form method="GET" action="<?php echo e(route('stok.tersedia')); ?>" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari Kode atau Nama Barang..." class="px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                
                <select name="kategori_id" class="px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">-- Semua Kategori --</option>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k->id); ?>" <?php echo e(request('kategori_id') == $k->id ? 'selected' : ''); ?>><?php echo e($k->nama_kategori); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="filter_stok" class="px-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">-- Semua Kondisi Stok --</option>
                    <option value="menipis" <?php echo e(request('filter_stok') == 'menipis' ? 'selected' : ''); ?>>Stok Menipis (<= Minimal)</option>
                    <option value="habis" <?php echo e(request('filter_stok') == 'habis' ? 'selected' : ''); ?>>Stok Habis (0)</option>
                </select>

                <div class="flex space-x-2">
                    <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded-lg text-xs font-bold hover:bg-slate-900 transition flex-1">
                        <i class="fa-solid fa-filter mr-1"></i> Filter
                    </button>
                    <a href="<?php echo e(route('stok.tersedia')); ?>" class="px-3 py-2 bg-slate-200 text-slate-700 rounded-lg text-xs font-bold hover:bg-slate-300 transition flex items-center justify-center">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Stok Cards Grid -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 font-bold uppercase border-b border-slate-200">
                            <th class="py-3 px-4">Kode</th>
                            <th class="py-3 px-4">Nama Barang Kebersihan</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Satuan</th>
                            <th class="py-3 px-4 text-center">Stok Minimal</th>
                            <th class="py-3 px-4 text-center">Stok Tersedia</th>
                            <th class="py-3 px-4 text-center">Status Stok</th>
                            <th class="py-3 px-4 text-center">Lokasi Rak</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php $__empty_1 = true; $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3 px-4 font-mono font-bold text-indigo-700"><?php echo e($b->kode_barang); ?></td>
                                <td class="py-3 px-4 font-bold text-slate-800"><?php echo e($b->nama_barang); ?></td>
                                <td class="py-3 px-4 text-slate-600"><?php echo e($b->kategori->nama_kategori ?? '-'); ?></td>
                                <td class="py-3 px-4 text-slate-600 font-semibold"><?php echo e($b->satuan->nama_satuan ?? 'Pcs'); ?></td>
                                <td class="py-3 px-4 text-center font-bold text-slate-500"><?php echo e(number_format($b->stok_minimal)); ?></td>
                                <td class="py-3 px-4 text-center">
                                    <span class="text-base font-black <?php echo e($b->stok <= 0 ? 'text-red-600' : ($b->stok <= $b->stok_minimal ? 'text-amber-600' : 'text-emerald-600')); ?>">
                                        <?php echo e(number_format($b->stok)); ?>

                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <?php if($b->stok <= 0): ?>
                                        <span class="px-2.5 py-1 bg-red-100 text-red-800 rounded-full font-black text-xs">STOK HABIS</span>
                                    <?php elseif($b->stok <= $b->stok_minimal): ?>
                                        <span class="px-2.5 py-1 bg-amber-100 text-amber-800 rounded-full font-black text-xs">MENIPIS</span>
                                    <?php else: ?>
                                        <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 rounded-full font-black text-xs">AMAN</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 text-center font-mono text-slate-500"><?php echo e($b->lokasi_rak ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="py-8 text-center text-slate-400">Tidak ada data stok.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                <?php echo e($barangs->links()); ?>

            </div>
        </div>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\gudang-pt-vsj\resources\views/stok/tersedia.blade.php ENDPATH**/ ?>