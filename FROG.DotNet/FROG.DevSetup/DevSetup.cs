using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace FROG.DevSetup
{
    public class DevSetup
    {
        public void RunSetup()
        {
            // Get set of tasks.
            TextEditorSetupTask textEditorSetup = new TextEditorSetupTask(@"C:\data\test_install_dir", TextEditor.NotepadPlusPlus);

            // Create a task but do not start it.
            Task textEditorSetupTask = new Task(textEditorSetup.GetAction(), textEditorSetup);
            textEditorSetupTask.Start();
            
            textEditorSetupTask.Wait();
        }
    }
}
