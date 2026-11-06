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
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-slate-800 tracking-tight">BACKUP DATABASE OTOMATIS</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola riwayat cadangan database PT Gudang Kebersihan VSJ yang dijadwalkan otomatis setiap hari jam 00:00 WIB</p>
            </div>
            
            <form method="POST" action="<?php echo e(route('backup.create')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-extrabold text-xs shadow-md flex items-center space-x-2 transition">
                    <i class="fa-solid fa-database"></i>
                    <span>Backup Database Sekarang</span>
                </button>
            </form>
        </div>

        <!-- System Schedule Status Banner -->
        <div class="bg-gradient-to-r from-indigo-900 to-blue-900 text-white p-5 rounded-2xl shadow-sm space-y-2">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-700/50 flex items-center justify-center text-xl text-indigo-200">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-sm text-white">Jadwal Backup Otomatis: Setiap Hari Jam 00:00 WIB</h3>
                    <p class="text-xs text-indigo-200 mt-0.5">Sistem secara otomatis akan mencadangkan database setiap tengah malam WIB dan menyimpan riwayat hingga 30 hari.</p>
                </div>
            </div>
        </div>

        <!-- Backups List Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 font-bold uppercase border-b border-slate-200">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Nama File Backup</th>
                            <th class="py-3 px-4">Tanggal & Waktu Dibuat</th>
                            <th class="py-3 px-4">Ukuran File</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php $__empty_1 = true; $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3 px-4 text-slate-400 font-bold"><?php echo e($index + 1); ?></td>
                                <td class="py-3 px-4 font-mono font-bold text-indigo-700">
                                    <i class="fa-solid fa-file-shield text-indigo-500 mr-2"></i> <?php echo e($b['filename']); ?>

                                </td>
                                <td class="py-3 px-4 font-semibold text-slate-700"><?php echo e($b['date']); ?> WIB</td>
                                <td class="py-3 px-4 text-slate-600 font-medium"><?php echo e($b['size']); ?></td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="<?php echo e(route('backup.download', $b['filename'])); ?>" class="px-3 py-1 bg-emerald-100 text-emerald-800 hover:bg-emerald-200 rounded-lg font-bold text-[11px] inline-flex items-center space-x-1 transition">
                                            <i class="fa-solid fa-download"></i>
                                            <span>Download</span>
                                        </a>
                                        <form method="POST" action="<?php echo e(route('backup.destroy', $b['filename'])); ?>" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file backup ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="px-2.5 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg font-bold text-[11px] transition">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">Belum ada file backup database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
<?php /**PATH C:\laragon\www\gudang-pt-vsj\resources\views/backup/index.blade.php ENDPATH**/ ?>