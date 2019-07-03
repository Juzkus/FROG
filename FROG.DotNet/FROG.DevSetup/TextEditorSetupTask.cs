using System;
using System.Collections.Generic;
using System.IO;
using System.IO.Compression;
using System.Net.Http;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace FROG.DevSetup
{
    public class TextEditorSetupTask
    {
        private string installDirectory = null;
        private TextEditor editor = TextEditor.Default;

        public TextEditorSetupTask(string installationDirectory, TextEditor editor)
        {
            this.editor = editor;
            installDirectory = installationDirectory;
        }

        public Action<object> GetAction()
        {
            return async (object obj) =>
            {
                await Run();
            };
        }

        public async Task Run()
        {
            Console.WriteLine("Downloading text editor.");
            var editorDownload = DownloadTextEditor();
            await editorDownload;

            Console.WriteLine("Installing text editor.");
        }

        private async Task DownloadTextEditor()
        {
            HttpResponseMessage editorZip = null;
            try
            {
                editorZip = await new HttpClient().GetAsync("https://notepad-plus-plus.org/repository/7.x/7.7.1/npp.7.7.1.bin.x64.zip", HttpCompletionOption.ResponseContentRead);
            }
            catch (Exception e)
            {
                Console.WriteLine("oops.");
            }

            // Success! Unzip to installDirectory.
            if (editorZip != null)
            {
                string tmpZipFileName = Guid.NewGuid().ToString().Replace("-","").ToLowerInvariant() + ".zip";
                string tmpFileDir = Path.GetTempPath();
                string tmpZipFilePath = Path.Combine(tmpFileDir, tmpZipFileName);

                var zipFileBytes = Encoding.Default.GetBytes(await editorZip.Content.ReadAsStringAsync());
                File.WriteAllBytes(tmpZipFilePath, zipFileBytes);
                // var zip = new ZipArchive(await editorZip.Content.ReadAsStreamAsync());

                ZipFile.ExtractToDirectory(tmpZipFilePath, installDirectory);
                /*
                var unzipFileTasks = new List<Task>();

                foreach (var zipEntry in zip.Entries)
                {
                    Console.WriteLine("copying file: " + zipEntry.FullName);

                    // skip zip entries that end with period.
                    if (zipEntry.FullName.EndsWith('.'))
                    {
                        continue;
                    }

                    // if the zip entry is a directory,
                    if (zipEntry.FullName.EndsWith(Path.DirectorySeparatorChar)
                        || zipEntry.FullName.EndsWith('/'))
                    {
                        var newDirPath = Path.Combine(installDirectory, zipEntry.FullName);
                        
                        // create the directory
                        if (!Directory.Exists(newDirPath))
                        {
                            Directory.CreateDirectory(newDirPath);
                        }
                    }
                    else
                    {
                        using (var zipStream = new StreamReader(zipEntry.Open()))
                        {
                            // Encoding.UTF8
                            var fileBytes = Encoding.UTF8.GetBytes(await zipStream.ReadToEndAsync());
                            unzipFileTasks.Add(System.IO.File.WriteAllBytesAsync(System.IO.Path.Combine(installDirectory, zipEntry.FullName), fileBytes));
                        }
                    }                    
                }

                foreach (var unzipTask in unzipFileTasks)
                {
                    await unzipTask;
                }
                */
            }            

            Console.WriteLine("Text editor is downloaded.");
        }
    }
}
